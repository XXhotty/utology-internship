<?php
include_once __DIR__ . '/libs/Smarty.class.php';
$smarty = new Smarty();
$smarty->escape_html = true;
$smarty->template_dir = __DIR__ . '/templates';
$smarty->compile_dir = __DIR__ . '/templates_c';

require_once __DIR__ . '/libs/dao/AccessDao.php';
$db = new DB(localhost,hotty,hotta,board);

if(isset($_POST["word"])){
    $word = $_POST["word"];
    $sql = "SELECT * FROM mp4 WHERE title LIKE N'%ら%';";
    $result = $db->fetch($sql);
    var_dump($result);
}else{
    $sql = "SELECT * FROM mp4 ORDER BY id;";
    $result = $db->fetch($sql);
}
$smarty->assign('result', $result);
$smarty->display('VideoList.tpl');

