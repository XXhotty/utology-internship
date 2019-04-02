<?php

namespace uploads\controller;

//use libs\util\UploadsUtil;
use libs\smarty\UploadsSmarty;
class VideoListController extends UploadsBaseController
{

    protected $template = 'uploads/VideoList.tpl';

    protected function main()
    {
        $smarty = UploadsSmarty::getSmarty();

        if(isset($_POST["word"])){
            $word = $_POST["word"];
            $result = UploadsDao::word($word);
        }else{
            $result = UploadsDao::mp4();
        }
        $smarty->assign('result', $result);
    }
}