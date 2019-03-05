<?php
//ajax送信でPOSTされたデータを受け取る
$post_data_1 = $_POST['post_data_1'];
$post_data_2 = $_POST['post_data_2'];
//受け取ったデータを配列に格納
//そのまま返すだけだと伝わりにくいので、文字を加工して返す
$return_array = array("PHPに送られたpost_data_1:".$post_data_1, "PHPに送られたpost_data_2:".$post_data_2);
//ヘッダーの設定


$DBSERVER = 'localhost';
$DBNAME = 'board';
$DBUSER = 'hotty'; //作成したユーザー名
$DBPASSWD = 'hotta'; //作成したユーザーのパスワード
$dsn = 'mysql:host={$DBSERVER};dbname={$DBNAME};charset=utf8';
$pdo = new \PDO('mysql:host=localhost;dbname=board', $DBUSER, $DBPASSWD, array(\PDO::ATTR_EMULATE_PREPARES => false));
if (!$pdo)
{
    exit('データベースと接続できませんでした。');
}

if ( $post_data_1 !== '' && $post_data_2 !== '' ) {
    $sql = 'INSERT INTO `board` (name, comment, created) VALUES (:name, :comment, NOW())';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', $post_data_1, \PDO::PARAM_STR);
    $stmt->bindValue(':comment', $post_data_2, \PDO::PARAM_STR);
    $stmt->execute();
    $return_array = array("PHPに送られたpost_data_1:".$post_data_1, "PHPに送られたpost_data_2:".$post_data_2);
}
else{
    $return_array = array("mysqlに保存失敗しました。PHPに送られたpost_data_1:".$post_data_1, "PHPに送られたpost_data_2:".$post_data_2);

}

header('Content-type:application/json; charset=utf8');
//「$return_array」をjson_encodeして出力
echo json_encode($return_array);