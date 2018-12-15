<?php

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


$err_msg = '';

if ( isset( $_POST['send'] ) === true ) {

    $name     = $_POST['name']   ;
    $comment = $_POST['comment'];

    if ( $name !== '' && $comment !== '' ) {

        $sql = 'INSERT INTO `board` (name, comment, created) VALUES (:name, :comment, NOW())';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $name, \PDO::PARAM_STR);
        $stmt->bindValue(':comment', $comment, \PDO::PARAM_STR);
        $stmt->execute();

    }else{
        $err_msg = '名前とコメントを記入してください';
    }
}

$sql = 'SELECT * FROM `board`';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$messages = $stmt->fetchAll();

?>
</head>
<body>
<form method="post" action="">
    名前<input type="text" name="name" value="" />
    コメント<textarea name="comment" rows="4" cols="20"></textarea>
    <input type="submit" name="send" value="書き込む" />
</form>
<!-- ここに、書き込まれたデータを表示する -->
<?php
if ( $err_msg !== '' ) echo '<p>' . $err_msg . '</p>';
foreach ($messages as &$message) {
    echo "名前:".$message['name']." ";
    echo "コメント:".$message['comment']." ";
    echo "時間:".$message['created'].'</br>';
}
?>
</body>