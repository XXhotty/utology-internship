<?php

namespace uploads\controller;

//use libs\util\UploadsUtil;

class VideoPlayController extends UploadsBaseController
{

    protected $template = 'uploads/VideoList.tpl';

    protected function main()
    {
        $resultDao = new UploadsDao();

        $result = $resultDao->commentGet();
        $result2 = $resultDao->videogGet();

        $comment = array("");
        $time = array("");
        $message ='';

        if (isset($_POST["sub"])) {
            $sub = $_POST["sub"];
            $id = explode(".", $sub);
            foreach ($result as $row) {
              if ($row["videoId"] == $id[0]) {
                  array_push($comment, $row["comment"]);
                  array_push($time, $row["time"]);
                }
         }
           $I = json_encode($id[0]);
           $C = json_encode($comment);
          $T = json_encode($time);
           foreach ($result2 as $row) {
               if ($row["id"] == $id[0]) {
                   $target = "../files/" . $row["name"];
               }
           }
        }else {
         $message ='動画一覧画面で動画を選択してください';
        }

        $this->smarty->assign('message', $message);
        $this->smarty->assign('target', $target);
        $this->smarty->display('VideoPlay.tpl');
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" >
            let id = <?php echo $I; ?>;
            let comment = <?php echo $C; ?>;
            let time = <?php echo $T; ?>;
            console.log(comment);
            console.log(time);
            count = 0;
            window.onload = function() {
                target = document.getElementById("output");
            };
            function video_play() {
                empty = "コメントなし";
                console.log(count++);
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
                  console.log(CC);
                  return count;
              };
              I = setInterval(countup, 1000);
              return count;
            }
            function video_pause() {
                video.pause();
                clearInterval(I);
            }
            function comment_ajax() {
                let newComment = document.form.comment.value;
                console.log(newComment);
                $.ajax({
                    url : "../../api/VideoPlayApi.php",
                    type : "POST",
                    data : {post_data_1:id, post_data_2:newComment, post_data_3:count}
                }).done(function(response, textStatus, xhr) {
                    console.log("ajax通信に成功しました");
                    console.log(response[0]);
                    console.log(response[1]);
                    console.log(response[2]);
                    /*
                    $("#response0").text(response[0]);
                    $("#response1").text(response[1]);
                    $("#response2").text(response[2]);
                    */
                    CC = CC + ' ' + response[1];
                    target.innerHTML = CC;
                }).fail(function(xhr, textStatus, errorThrown) {
                    console.log("ajax通信に失敗しました");
                });
            }
        </script>

        <?php
        $this->smarty->assign('result', $result);
    }
}
