<?php
try{
    $user = "hotty";
    $pass = "hotta";
    $pdo = new PDO("mysql:host=localhost;dbname=board;charset=utf8", $user, $pass);

    //ファイルアップロードがあったとき
    if (isset($_FILES['upfile']['error']) && is_int($_FILES['upfile']['error']) && $_FILES["upfile"]["name"] !== ""){
        //エラーチェック
        switch ($_FILES['upfile']['error']) {
            case UPLOAD_ERR_OK: // OK
                break;
            case UPLOAD_ERR_NO_FILE:   // 未選択
                throw new RuntimeException('ファイルが選択されていません', 400);
            case UPLOAD_ERR_INI_SIZE:  // php.ini定義の最大サイズ超過
                throw new RuntimeException('ファイルサイズが大きすぎます', 400);
            default:
                throw new RuntimeException('その他のエラーが発生しました', 500);
        }

        //画像・動画をバイナリデータにする．
        $raw_data = file_get_contents($_FILES['upfile']['tmp_name']);

        //拡張子を見る
        $tmp = pathinfo($_FILES["upfile"]["name"]);
        $extension = $tmp["extension"];
        if($extension === "jpg" || $extension === "jpeg" || $extension === "JPG" || $extension === "JPEG"){
            $extension = "jpeg";
        }
        elseif($extension === "png" || $extension === "PNG"){
            $extension = "png";
        }
        elseif($extension === "gif" || $extension === "GIF"){
            $extension = "gif";
        }
        elseif($extension === "mp4" || $extension === "MP4"){
            $extension = "mp4";
        }
        else{
            echo "非対応ファイルです．<br/>";
            echo ("<a href=\"3-3.php\">戻る</a><br/>");
            exit(1);
        }

        //DBに格納するファイルネーム設定
        //サーバー側の一時的なファイルネームと取得時刻を結合した文字列にsha256をかける．
        $date = getdate();
        $fname = $_FILES["upfile"]["tmp_name"].$date["year"].$date["mon"].$date["mday"].$date["hours"].$date["minutes"].$date["seconds"];
        $fname = hash("sha256", $fname);

        //画像・動画をDBに格納．
        $sql = "INSERT INTO media(fname, extension, raw_data) VALUES (:fname, :extension, :raw_data);";
        $stmt = $pdo->prepare($sql);
        $stmt -> bindValue(":fname",$fname, PDO::PARAM_STR);
        $stmt -> bindValue(":extension",$extension, PDO::PARAM_STR);
        $stmt -> bindValue(":raw_data",$raw_data, PDO::PARAM_STR);
        $stmt -> execute();

    }

}
catch(PDOException $e){
    echo("<p>500 Inertnal Server Error</p>");
    exit($e->getMessage());
}


include_once __DIR__ . '/libs/Smarty.class.php';

// smartyを宣言して設定を書き加えます
$smarty = new Smarty();
$smarty->escape_html = true;
$smarty->template_dir = __DIR__ . '/templates';
$smarty->compile_dir = __DIR__ . '/templates_c';


$DBSERVER = 'localhost';
$DBNAME = 'board';
$DBUSER = 'hotty'; //作成したユーザー名
$DBPASSWD = 'hotta'; //作成したユーザーのパスワード
$dsn2 = 'mysql:host={$DBSERVER};dbname={$DBNAME};charset=utf8';
$pdo2 = new \PDO('mysql:host=localhost;dbname=board', $DBUSER, $DBPASSWD, array(\PDO::ATTR_EMULATE_PREPARES => false));
if (!$pdo2)
{
    exit('データベースと接続できませんでした。');
}


$err_msg = '';

if ( isset( $_POST['send'] ) === true ) {

    $name     = $_POST['name'];
    $comment = $_POST['comment'];
    $created = $_POST['created'];

    if ( $name !== '' && $comment !== '' && $created !=='') {

        $sql2 = 'INSERT INTO `videocomment` (name, comment, created) VALUES (:name, :comment, :created)';
        $stmt2 = $pdo2->prepare($sql2);
        $stmt2->bindValue(':name', $name, \PDO::PARAM_STR);
        $stmt2->bindValue(':comment', $comment, \PDO::PARAM_STR);
        $stmt2->bindValue(':created', $created, \PDO::PARAM_STR);
        $stmt2->execute();

    }else{
        $err_msg = '名前とコメントを記入してください';
    }
}

?>



<!DOCTYPE HTML>

<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>media</title>
</head>

<body>
<form action="3-3.php" enctype="multipart/form-data" method="post">
    <label>画像/動画アップロード</label>
    <input type="file" name="upfile">
    <br>
    ※画像はjpeg方式，png方式，gif方式に対応しています．動画はmp4方式のみ対応しています．<br>
    <input type="submit" value="アップロード">
</form>

<?php
echo("$err_msg");
$sql2 = 'SELECT * FROM `videocomment`';
$stmt2 = $pdo2->prepare($sql2);
$stmt2->execute();
$messages = $stmt2->fetchAll();


$smarty->assign('err_msg', $err_msg);
$smarty->assign('messages', $messages);

$smarty->display('3-8.tpl');
?>

<form method="POST" action="">

    <?php
    $sql = "SELECT * FROM media ORDER BY id;";
    $stmt = $pdo->prepare($sql);
    $stmt -> execute();
    $number = 0;
    while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
        $number = $number + 1;
        echo ($row["id"]."<br/>");
        //動画と画像で場合分け
        $target = $row["fname"];
        if($row["extension"] == "mp4"){

            echo ("<input type=\"submit\" value='[$target][$number]' name=\"sub1\">　");



        }
        elseif($row["extension"] == "jpeg" || $row["extension"] == "png" || $row["extension"] == "gif"){
            echo ("<img src='3-2.php?target=$target'>");
        }
        echo ("<br/><br/>");
    }
    ?>
</form>

<?php
if (isset($_POST["sub1"])) {
    $sub1 =  $_POST["sub1"];
    $videonum = $sub1[0];
    echo("$sub1[1]");
    $smarty->assign('comnum', $sub1[1]);
    echo ("<video id =video src=\"3-2.php?target=$videonum\" width=\"426\" height=\"240\" controls></video>");
}

?>

</body>
</html>