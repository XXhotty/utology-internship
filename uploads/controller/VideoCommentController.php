
<?php
require_once __DIR__ . '/../../libs/smarty/VideoSmarty.php';
$sm = new VideoSmarty();
$smarty = $sm->getSmarty();

require_once __DIR__ . '/../../libs/dao/AccessDao.php';
$db = new DB(localhost,hotty,hotta,board);

$message = '';

if (isset($_POST["videoname"])) {
    $videoname = $_POST["videoname"];
    $comment = $_POST['comment'];
    $time = $_POST['time'];
    if ($videoname !== '' && $comment !== '' && $time !== '') {
        if (ctype_digit($time)) {
            $result = $db->comment($videoname, $comment, $time);
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
$smarty->assign('videoname', $videoname);
$smarty->display('VideoComment.tpl');