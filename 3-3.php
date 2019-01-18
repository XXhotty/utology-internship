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


?>


<script type="text/javascript">
    function video_play() {
        video.play();
    }
    function video_pause() {
        video.pause();
    }
</script>


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
//DBから取得して表示する．
$sql = "SELECT * FROM media ORDER BY id;";
$stmt = $pdo->prepare($sql);
$stmt -> execute();
while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
    echo ($row["id"]."<br/>");
    //動画と画像で場合分け
    $target = $row["fname"];
    if($row["extension"] == "mp4"){

        echo ("<video id =video src=\"3-2.php?target=$target\" width=\"426\" height=\"240\" controls></video>");

        echo ("<br/>");
        echo("\"id\"");
        echo ("<br/>");

        echo ("<br/>");
        echo ("<input type='button' value='play' onclick='video_play()')>");
        echo ("<input type='button' value='pause' onclick='video_pause()'>");

    }
    elseif($row["extension"] == "jpeg" || $row["extension"] == "png" || $row["extension"] == "gif"){
        echo ("<img src='3-2.php?target=$target'>");
    }
    echo ("<br/><br/>");
}
?>



</body>
</html>