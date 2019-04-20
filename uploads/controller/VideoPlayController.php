<?php

namespace uploads\controller;

//use libs\util\UploadsUtil;
use libs\dao\UploadsDao;
class VideoPlayController extends UploadsBaseController
{

    protected $template = 'uploads/VideoPlay.tpl';

    protected function main()
    {
        $resultDao = new UploadsDao();

        $result = $resultDao->commentGet();
        $result2 = $resultDao->videoGet();

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
           foreach ($result2 as $row) {
               if ($row["id"] == $id[0]) {
                   $target = "../files/" . $row["name"];
                   $videoName = $row["title"];
               }
           }
        }else {
         $message ='動画一覧画面で動画を選択してください';
        }

        var_dump($comment);
        var_dump($time);

        $this->smarty->assign('message', $message);
        $this->smarty->assign('target', $target);

        $this->smarty->assign('videoName', $videoName);
        $this->smarty->assign('videoId', $id[0]);
        $this->smarty->assign('comment', $comment);
        $this->smarty->assign('time', $time);


        $this->smarty->assign('result', $result);
    }
}
