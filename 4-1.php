<?php

include_once __DIR__ . '/libs/Smarty.class.php';
$smarty = new Smarty();
$smarty->escape_html = true;
$smarty->template_dir = __DIR__ . '/templates';
$smarty->compile_dir = __DIR__ . '/templates_c';

$DBSERVER = "localhost";
$DBUSER = "hotty";
$DBPASSWD = "hotta";
$DBNAME = "board";

require_once __DIR__ . '/libs/dao/Database.php';
require_once __DIR__ . '/libs/dao/UploadDao.php';

$name = $_FILES["upfile"]["name"];
$title     = $_POST['title'];
$tmp = pathinfo($_FILES["upfile"]["name"]);
$extension = $tmp["extension"];



if ($name !== '' && is_uploaded_file($_FILES["upfile"]["tmp_name"])){
    if ($extension == "mp4") {
        if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "files/" . $_FILES["upfile"]["name"])) {
            chmod("files/" . $_FILES["upfile"]["name"], 0644);
            $messages =$_FILES["upfile"]["name"] . "をアップロードしました。";

            create($name, $title);
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
$smarty->display('4-1.tpl');

