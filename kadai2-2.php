<?php

$DBSERVER = 'localhost';
$DBNAME = 'board';
$DBUSER = 'hotty'; //作成したユーザー名
$DBPASSWD = 'hotta'; //作成したユーザーのパスワード
$dsn = 'mysql:host={$DBSERVER};dbname={$DBNAME};charset=utf8';
$pdo = new \PDO($dsn, $DBUSER, $DBPASSWD, array(\PDO::ATTR_EMULATE_PREPARES => false));

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
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
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
if ( $messages     !== '' ) echo '<p>' . $messages . '</p>';

?>
</body>