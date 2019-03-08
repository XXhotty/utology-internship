<?php
require_once __DIR__ . '/libs/dao/AccessDao.php';
$db = new DB(localhost,hotty,hotta,board);

//ajax送信でPOSTされたデータを受け取る
$post_data_1 = $_POST['post_data_1'];
$post_data_2 = $_POST['post_data_2'];
$post_data_3 = $_POST['post_data_3'];

if ( $post_data_1 !== '' && $post_data_2 !== ''&& $post_data_3 !== '' ) {
    /*
    $result = $db->comment($post_data_1, $post_data_2, $post_data_3);
    */
    $return_array = array("PHPに送られたpost_data_1:".$post_data_1, "PHPに送られたpost_data_2:".$post_data_2, "PHPに送られたpost_data_3:".$post_data_3);
}
else{
    $return_array = array("mysqlに保存失敗しました。PHPに送られたpost_data_1:".$post_data_1, "PHPに送られたpost_data_2:".$post_data_2, "PHPに送られたpost_data_3:".$post_data_3);

}

header('Content-type:application/json; charset=utf8');
//「$return_array」をjson_encodeして出力
echo json_encode($return_array);