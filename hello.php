<?php
 // smarty �̃��C�u������ǂݍ��݂܂�
 include_once __DIR__ . '/libs/smarty.class.php';
 
 // smarty��錾���Đݒ�����������܂�
 $smarty = new Smarty();
 $smarty->escape_html = true;
 $smarty->template_dir = __DIR__ . '/templates';
 $smarty->compile_dir = __DIR__ . '/templates_c';
 
 $name = '�c��';
 $smarty->assign('name', $name);
 $smarty->display('hello.tpl');
?>