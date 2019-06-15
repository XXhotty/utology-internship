<?php

namespace uploads\controller;

//use libs\util\UploadsUtil;
use libs\smarty\UploadsSmarty;
use libs\dao\UploadsDao;
class VideoListController extends UploadsBaseController
{

    protected $template = 'uploads/VideoList.tpl';

    protected function main()
    {
        $resultDao = new UploadsDao();

        if(isset($_POST["word"])){
            $word = $_POST["word"];
            $result = $resultDao->word($word);
        }else{
            $result = $resultDao->mp4();
        }
        $this->smarty->assign('result', $result);
    }
}