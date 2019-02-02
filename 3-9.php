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


    echo("a.<br/>");
    $basename = $_FILES['upfile']['name'];
    echo("$basename");
    echo("<br/>");
    echo("a.<br/>");

    $uploads_dir = '/uploads';
    move_uploaded_file($basename, "$uploads_dir/$basename");

}
catch(PDOException $e){
    echo("<p>500 Inertnal Server Error</p>");
    exit($e->getMessage());
}


// smarty のライブラリを読み込みます
include_once __DIR__ . '/libs/Smarty.class.php';

// smartyを宣言して設定を書き加えます
$smarty = new Smarty();
$smarty->escape_html = true;
$smarty->template_dir = __DIR__ . '/templates';
$smarty->compile_dir = __DIR__ . '/templates_c';

$smarty->display('3-9.tpl');


