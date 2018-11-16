<?php
 // smarty ‚Ìƒ‰ƒCƒuƒ‰ƒŠ‚ð“Ç‚Ýž‚Ý‚Ü‚·
 include_once __DIR__ . '/libs/smarty.class.php';
 
 // smarty‚ðéŒ¾‚µ‚ÄÝ’è‚ð‘‚«‰Á‚¦‚Ü‚·
 $smarty = new Smarty();
 $smarty->escape_html = true;
 $smarty->template_dir = __DIR__ . '/templates';
 $smarty->compile_dir = __DIR__ . '/templates_c';
 
 $name = '“c’†';
 $smarty->assign('name', $name);
 $smarty->display('hello.tpl');
?>