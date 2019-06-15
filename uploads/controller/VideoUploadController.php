<?php

namespace uploads\controller;

//use libs\util\UploadsUtil;
use libs\smarty\UploadsSmarty;
use libs\dao\UploadsDao;
class VideoUploadController extends UploadsBaseController
{

    protected $template = 'uploads/VideoUpload.tpl';

    protected function main()
    {
        $resultDao = new UploadsDao();
        $messages ='';

        if ( isset( $_POST['send'] ) === true ) {
            if ($_FILES['upfile']['error'] !== '' && is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
                $name = $_FILES["upfile"]["name"];
                $title = $_POST['title'];
                $tmp = pathinfo($_FILES["upfile"]["name"]);
                $extension = $tmp["extension"];
                if ($extension == "mp4") {
                    if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "../files/" . $_FILES["upfile"]["name"])) {
                        chmod("../files/" . $_FILES["upfile"]["name"], 0644);
                        $messages = $_FILES["upfile"]["name"] . "をアップロードしました。";
                        $result = $resultDao->create($name,$title);
                    } else {
                        $messages = "ファイルをアップロードできません。";
                    }
                } else {
                    $messages = "非対応ファイルです";
                }
            } else {
                $messages = "タイトルが入力されていない、もしくはファイルが選択されていません。";
            }
        }

        $this->smarty->assign('messages', $messages);
    }
}