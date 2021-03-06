<?php

// smarty のライブラリを読み込みます
include_once __DIR__ . '/libs/Smarty.class.php';
// smartyを宣言して設定を書き加えます
$smarty = new Smarty();
$smarty->escape_html = true;
$smarty->template_dir = __DIR__ . '/templates';
$smarty->compile_dir = __DIR__ . '/templates_c';

try {
    $user = "hotty";
    $pass = "hotta";
    $pdo = new PDO("mysql:host=localhost;dbname=board;charset=utf8", $user, $pass);

    $messages ='a';
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

    $title     = $_POST['title'];
    $tmp = pathinfo($_FILES["upfile"]["name"]);
    $extension = $tmp["extension"];
    if ($name !== '' && is_uploaded_file($_FILES["upfile"]["tmp_name"])){
        if ($extension == "mp4") {
            if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "files/" . $_FILES["upfile"]["name"])) {
                chmod("files/" . $_FILES["upfile"]["name"], 0644);
                $messages =$_FILES["upfile"]["name"] . "をアップロードしました。";

                $name = $_FILES["upfile"]["name"];
                $sql = 'INSERT INTO `mp4` (name, title, created) VALUES (:name,:title, NOW())';
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':name', $name, \PDO::PARAM_STR);
                $stmt->bindValue(':title', $title, \PDO::PARAM_STR);
                $stmt->execute();
            }
            else {
                $messages = "ファイルをアップロードできません。";
            }
        }
        else {
            $messages ="非対応ファイルです";
        }
    }
    else {
        $messages = "タイトルが入力されていない、もしくはファイルが選択されていません。";
    }

    $smarty->assign('messages', $messages);
}
catch(PDOException $e){
    echo("<p>500 Inertnal Server Error</p>");
    exit($e->getMessage());
}



$smarty->display('3-9.tpl');

