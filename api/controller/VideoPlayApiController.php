<?php

namespace api\controller;

//use libs\util\UploadsUtil;

use libs\dao\UploadsDao;
class VideoPlayApiController extends ApiBaseController
{
    protected function main()
    {
        $resultDao = new UploadsDao();
        $post_data_1 = $_POST['post_data_1'];
        $post_data_2 = $_POST['post_data_2'];
        $post_data_3 = $_POST['post_data_3'];

        if ( $post_data_1 !== '' && $post_data_2 !== ''&& $post_data_3 !== '' ) {
            $result = $resultDao->commentWrite($post_data_1, $post_data_2, $post_data_3);
            $return_array = array($post_data_1,$post_data_2,$post_data_3);
        }
        else{
            $return_array = array($post_data_1,$post_data_2,$post_data_3);
        }

        header('Content-type:application/json; charset=utf8');
//「$return_array」をjson_encodeして出力
        echo json_encode($return_array);
    }
}
