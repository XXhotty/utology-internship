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

        $comments = [];
        $message ='';

        if (isset($_POST["sub"])) {
            $id = $_POST["videoId"];
            foreach ($result as $row) {
                $comments[] = [
                    'comment' => $row['comment'],
                    'time' =>  $row['time']
                ];
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

        $Jcomments = json_encode($comments);

        $this->smarty->assign('message', $message);
        $this->smarty->assign('target', $target);

        $this->smarty->assign('videoName', $videoName);
        $this->smarty->assign('videoId', $id[0]);
        $this->smarty->assign('comments', $comments);
        $this->smarty->assign('Jcomments', $Jcomments);

    }
}
