 <?php
 include_once 'smarty.class.php';
 $fruit = 'りんご';
 $smarty = new Smarty();
 $smarty->assign('fruit', $fruit);
 $smarty->display('test.tpl');