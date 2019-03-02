
<?php
include_once __DIR__ . '/libs/Smarty.class.php';
$smarty = new Smarty();
$smarty->escape_html = true;
$smarty->template_dir = __DIR__ . '/templates';
$smarty->compile_dir = __DIR__ . '/templates_c';

require_once __DIR__ . '/libs/dao/AccessDao.php';
$db = new DB(localhost,hotty,hotta,board);

$message = '';

if (isset($_POST["videoId"])) {
    $videoId = $_POST["videoId"];
    $comment = $_POST['comment'];
    $time = mb_convert_kana($_POST['time'],"a");
    if ($videoId !== '' && $comment !== '' && $time !== '') {
        if (ctype_digit($time)) {
            $result = $db->comment($videoId, $comment, $time);
            $message ='コメントしました';
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

$smarty->assign('message', $message);
$smarty->assign('videoId', $videoId);
$smarty->display('VideoComment.tpl');