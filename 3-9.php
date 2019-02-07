<?php
$updir = "./upload/";
$filename = $_FILES['upfile']['name'];
if(move_uploaded_file($_FILES['upfile']['tmp_name'], $updir.$filename)==FALSE){
    print("Upload failed");
    print($_FILES['upfile']['error']);
}
else {
    print("<b> $filename </b> uploaded");
}

// smartyを宣言して設定を書き加えます
$smarty = new Smarty();
$smarty->escape_html = true;
$smarty->template_dir = __DIR__ . '/templates';
$smarty->compile_dir = __DIR__ . '/templates_c';

$smarty->display('3-9.tpl');


