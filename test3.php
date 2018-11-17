 <?php
 ini_set('display_errors', 1);
 error_reporting(E_ALL)
 include_once 'smarty.class.php';
 $fruit = 'りんご';
 $smarty = new Smarty();
 $smarty->assign('fruit', $fruit);
 $smarty->display('test.tpl');