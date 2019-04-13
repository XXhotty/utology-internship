<?php

namespace uploads\controller;

//use libs\util\UploadsUtil;
use libs\smarty\UploadsSmarty;
use libs\dao\UploadsDao;
class TestController extends UploadsBaseController
{

    protected $template = 'uploads/Test.tpl';

    protected function main()
    {
        $messages ='a';

        $this->smarty->assign('messages', $messages);
    }
}