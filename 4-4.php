
<?php
include_once __DIR__ . '/libs/Smarty.class.php';
$smarty = new Smarty();
$smarty->escape_html = true;
$smarty->template_dir = __DIR__ . '/templates';
$smarty->compile_dir = __DIR__ . '/templates_c';

$message = '';

if (isset($_POST["videoname"])) {
    $videoname = $_POST["videoname"];
    $comment = $_POST['comment'];
    $time = $_POST['time'];
    if ($videoname !== '' && $comment !== '' && $time !== '') {
        if (ctype_digit($time)) {
            $result = $db->comment($name, $comment, $time);
        }
        else{
            $message ='時間の入力は整数のみです';
        }
    }
    else{
        $message ='時間とコメントを入力してください';
    }
}
else{
    $message ='動画一覧画面で動画を選択してください';
}

$smarty->assign('videoname', $videoname);
$smarty->display('4-4.tpl');