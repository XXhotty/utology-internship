<?php
include_once __DIR__ . '/../libs/Smarty.class.php';
$smarty = new Smarty();
$smarty->escape_html = true;
$smarty->template_dir = __DIR__ . '/../templates';
$smarty->compile_dir = __DIR__ . '/../templates_c';

require_once __DIR__ . '/../libs/dao/AccessDao.php';
$db = new DB(localhost,hotty,hotta,board);
if(isset($_POST["word"])){
    $word = $_POST["word"];
    $result = $db->word($word);
}else {
    $result = $db->mp4();
}
$smarty->assign('result', $result);
$smarty->display('VideoList.tpl');

