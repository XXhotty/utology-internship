<?php
echo("4-2started.<br/>");
include_once __DIR__ . '/libs/Smarty.class.php';
$smarty = new Smarty();
$smarty->escape_html = true;
$smarty->template_dir = __DIR__ . '/templates';
$smarty->compile_dir = __DIR__ . '/templates_c';

require_once __DIR__ . '/libs/dao/AccessDao.php';
$db = new DB(localhost,hotty,hotta,board);
$sql = "SELECT * FROM mp4 ORDER BY id;";
$result = $db->fetch($sql);

echo("require.<br/>");

$smarty->assign('result', $result);
$smarty->display('4-2.tpl');

