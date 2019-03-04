<?php
include_once __DIR__ . '/libs/Smarty.class.php';
$smarty = new Smarty();
$smarty->escape_html = true;
$smarty->template_dir = __DIR__ . '/templates';
$smarty->compile_dir = __DIR__ . '/templates_c';

require_once __DIR__ . '/libs/dao/AccessDao.php';
$db = new DB(localhost,hotty,hotta,board);
$sql = "SELECT * FROM videocomment ORDER BY id;";
$sql2 = "SELECT * FROM mp4 ORDER BY id;";
$result = $db->fetch($sql);
$result2 = $db->fetch($sql2);

$comment = array("");
$time = array("");
$message ='';

if (isset($_POST["sub"])) {
    $sub = $_POST["sub"];
    $id = explode(".", $sub);
    foreach ($result as $row) {
        if ($row["id"] == $id[0]) {
            array_push($comment, $row["comment"]);
            array_push($time, $row["time"]);
        }
    }
    $C = json_encode($comment);
    $T = json_encode($time);
    foreach ($result2 as $row) {
        if ($row["id"] == $id[0]) {
            $target = "files/" . $row["name"];
            $videoId = $row["id"];
        }
    }
}else {
    $message ='動画一覧画面で動画を選択してください';
}

if (isset($_POST["comment"])) {
    $N = json_encode(($_POST["comment"]));
}

if (isset($_POST["name1"])) {
    echo $_POST['name1'];
} else {
    echo "値が入力されていません";
}


$smarty->assign('message', $message);
$smarty->assign('target', $target);
$smarty->assign('videoId', $videoId);
$smarty->assign('sub', $sub);
$smarty->display('VideoPlay.tpl');
?>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js">
    var count = 1;
    let comment = <?php echo $C; ?>;
    let time = <?php echo $T; ?>;
    let newComment = <?php echo $N; ?>;
    console.log(newComment);

    $.ajax({
        type: 'POST',
        url: 'VideoPlay.php',
        dataType:'text',
        data: {
            name1 : "a"
        },
        success: function(data) {
            alert("success");
            //location.href = "./test.php";
        }
    });

    window.onload = function() {
        target = document.getElementById("output");
    };
    function video_play() {
        empty = "コメントなし";
        video.play();
        var countup = function(){
            len = comment.length;
            len++;
            CC = "";
            for (var i = 0; i < len; i++){
                if(count == time[i]){
                    CC = CC + ' ' + comment[i];
                    target.innerHTML = CC;
                }
                else if(CC == ""){
                    target.innerHTML = empty;
                }
            }
            console.log(count++);
        };
        I = setInterval(countup, 1000);
    }
    function video_pause() {
        video.pause();
        clearInterval(I);
    }
</script>
