 <?php
 include_once 'smarty.class.php';
 $fruit = '���';
 $smarty = new Smarty();
 $smarty->assign('fruit', $fruit);
 $smarty->display('test.tpl');