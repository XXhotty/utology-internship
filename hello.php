<?php
 // smarty のライブラリを読み込みます
 include_once __DIR__ . '/libs/smarty.class.php';
 
 // smartyを宣言して設定を書き加えます
 $smarty = new Smarty();
 $smarty->escape_html = true;
 $smarty->template_dir = __DIR__ . '/templates';
 $smarty->compile_dir = __DIR__ . '/templates_c';
 
 $name = '田中';
 $smarty->assign('name', $name);
 $smarty->display('hello.tpl');
?>