 <?php
 include_once 'smarty.class.php';
 $fruit = '‚è‚ñ‚²';
 $smarty = new Smarty();
 $smarty->assign('fruit', $fruit);
 $smarty->display('test.tpl');