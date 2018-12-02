<?php

$DBSERVER = 'localhost';
$DBNAME = 'board';
$DBUSER = 'board'; //作成したユーザー名
$DBPASSWD = 'pw'; //作成したユーザーのパスワード
$dsn = 'mysql:host={$DBSERVER};dbname={$DBNAME};charset=utf8';
$pdo = new \PDO($dsn, $DBUSER, $DBPASSWD, array(\PDO::ATTR_EMULATE_PREPARES => false));



$msg     = '';
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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>掲示板</title>
</head>
<body>
<?php echo $message; ?>
<form method="post" action="">
    名前：<input type="text" name="name" value="<?php echo $name; ?>" >
    <?php echo $err_msg1; ?><br>
    コメント：<textarea  name="comment" rows="4" cols="40"><?php echo $comment; ?></textarea>
    <?php echo $err_msg2; ?><br>
    <br>
    <input type="submit" name="send" value="クリック" >
</form>

</body>
</html>