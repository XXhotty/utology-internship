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

$smarty->assign('message', $message);
$smarty->assign('target', $target);
$smarty->assign('videoId', $videoId);
$smarty->assign('sub', $sub);
$smarty->display('VideoPlay.tpl');
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" >
    var count = 1;
    let comment = <?php echo $C; ?>;
    let time = <?php echo $T; ?>;
    let newComment = <?php echo $N; ?>;
    console.log(newComment);

    jQuery(function($){
        //ajax送信
        // **********************
        // URLをajax.phpにすること
        // **********************
        $.ajax({
            url : "VideoPlayApi.php",
            type : "POST",
            data : {post_data_1:"count", post_data_2:"newComment"}
        }).done(function(response, textStatus, xhr) {
            console.log("ajax通信に成功しました");
            console.log(response[0]);
            console.log(response[1]);

            //responseにはajax.phpが返したレスポンスが入っている

            // 元ページのresponse0のdivに、PHPから返されたresponse[0]を入れる
            $("#response0").text(response[0]);

            // 元ページのresponse1のdivに、PHPから返されたresponse[1]を入れる
            $("#response1").text(response[1]);

        }).fail(function(xhr, textStatus, errorThrown) {
            console.log("ajax通信に失敗しました");
        });
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
<?php
$post_data_1 = $_POST['post_data_1'];
$post_data_2 = $_POST['post_data_2'];
//受け取ったデータを配列に格納
$return_array = array($post_data_1, $post_data_2);
//「$return_array」をjson_encodeして出力
echo json_encode($return_array);