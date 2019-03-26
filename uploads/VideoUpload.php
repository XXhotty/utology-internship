<?php
include_once __DIR__ . '/../libs/Smarty.class.php';
$smarty = new Smarty();
$smarty->escape_html = true;
$smarty->template_dir = __DIR__ . '/../templates';
$smarty->compile_dir = __DIR__ . '/../templates_c';

require_once __DIR__ . '/../libs/dao/AccessDao.php';

$messages ='';

if ( isset( $_POST['send'] ) === true ) {
    if ($_FILES['upfile']['error'] !== '' && is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
        $name = $_FILES["upfile"]["name"];
        $title = $_POST['title'];
        $tmp = pathinfo($_FILES["upfile"]["name"]);
        $extension = $tmp["extension"];
        if ($extension == "mp4") {
            if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "files/" . $_FILES["upfile"]["name"])) {
                chmod("files/" . $_FILES["upfile"]["name"], 0644);
                $messages = $_FILES["upfile"]["name"] . "をアップロードしました。";
                $db = new DB(localhost,hotty,hotta,board);
                $result = $db->create($name,$title);
            } else {
                $messages = "ファイルをアップロードできません。";
            }
        } else {
            $messages = "非対応ファイルです";
        }
    } else {
        $messages = "タイトルが入力されていない、もしくはファイルが選択されていません。";
    }
}

$smarty->assign('messages', $messages);
$smarty->display('VideoUpload.tpl');