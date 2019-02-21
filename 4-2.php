<?php

require_once __DIR__ . '/libs/dao/AccessDao.php';
$db = new DB(localhost,hotty,hotta,board);
$sql = "SELECT * FROM mp4 ORDER BY id;";
$result = $db->fetch($sql);

$smarty->assign('result', $result);
$smarty->display('4-2.tpl');