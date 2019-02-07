<?php
try {
    $user = "hotty";
    $pass = "hotta";
    $pdo = new PDO("mysql:host=localhost;dbname=board;charset=utf8", $user, $pass);

    //ファイルアップロードがあったとき
    if (isset($_FILES['upfile']['error']) && $_FILES["upfile"]["name"] !== "") {
        //エラーチェック
        switch ($_FILES['upfile']['error']) {
            case UPLOAD_ERR_OK: // OK
                break;
            case UPLOAD_ERR_NO_FILE:   // 未選択
                throw new RuntimeException('ファイルが選択されていません', 400);
                echo("ファイルが選択されていません");
            case UPLOAD_ERR_INI_SIZE:  // php.ini定義の最大サイズ超過
                throw new RuntimeException('ファイルサイズが大きすぎます', 400);
            default:
                throw new RuntimeException('その他のエラーが発生しました', 500);
        }

    }

    echo("a.<br/>");
    $name = $_FILES['upfile']['name'];
    echo("$name");
    echo("<br/>");
    echo("a.<br/>");

    $tmp = pathinfo($_FILES["upfile"]["name"]);
    $extension = $tmp["extension"];
    echo("a.<br/>");
    echo("$extension");
    echo("<br/>");
    echo("a.<br/>");

    $tmpname = $_FILES["upfile"]["tmp_name"];
    echo("a.<br/>");
    echo("$tmpname");
    echo("<br/>");
    echo("a.<br/>");



    if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
        if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "files/" . $_FILES["upfile"]["name"])) {
            chmod("files/" . $_FILES["upfile"]["name"], 0644);
            echo $_FILES["upfile"]["name"] . "をアップロードしました。";
        }
        else {
            echo "ファイルをアップロードできません。";
        }
    }
    else {
        echo "ファイルが選択されていません。";
    }
}
catch(PDOException $e){
    echo("<p>500 Inertnal Server Error</p>");
    exit($e->getMessage());
}
// smarty のライブラリを読み込みます
include_once __DIR__ . '/libs/Smarty.class.php';

?>


<!DOCTYPE HTML>

<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>media</title>
</head>

<body>
<form action="3-9.php" enctype="multipart/form-data" method="post">
    <label>動画アップロード</label>
    <input type="file" name="upfile">
    <br>
    ※画像はjpeg方式，png方式，gif方式に対応しています．動画はmp4方式のみ対応しています．<br>
    <input type="submit" value="アップロード">
</form>

</body>
</html>