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
        $smarty = UploadsSmarty::getSmarty();

        if(isset($_POST["word"])){
            $word = $_POST["word"];
        }else{
            $word = '';
        }
        $resultDao = new UploadsDao();
        $test = $resultDao->test();
        echo("$test");
        $result = $resultDao->word($word);
        $smarty->assign('result', $result);
    }
}