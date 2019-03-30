<?php

namespace uploads\controller;

use libs\util\UploadsUtil;
use libs\smarty\UploadsSmarty;
class VideoListController extends UploadsBaseController
{

    protected $template = 'uploads/VideoList.tpl';

    protected function main()
    {
        $smarty = UploadsSmarty::getSmarty();
        $result = 'm';
        $smarty->assign('result', $result);

    }
}