﻿<?php
//var_dump($_POST);
//最初に変数を定義しておかないとエラーになる
$err_msg1 = "";
$err_msg2 = "";
$message ="";
$name = ( isset( $_POST["name"] ) === true ) ?$_POST["name"]: "";
$comment  = ( isset( $_POST["comment"] )  === true ) ?  trim($_POST["comment"])  : "";

$DBSERVER = 'localhost';
$DBNAME = 'board';
$DBUSER = 'hotty'; //作成したユーザー名
$DBPASSWD = 'hotta'; //作成したユーザーのパスワード
$dsn = "mysql:host={$DBSERVER};dbname={$DBNAME};charset=utf8';
 $pdo = new \PDO($dsn, $DBUSER, $DBPASSWD, array(\PDO::ATTR_EMULATE_PREPARES => false));

//投稿がある場合のみ処理を行う
if (  isset($_POST["send"] ) ===  true ) {
    if ( $name   === "" ) $err_msg1 = "名前を入力してください";

        if ( $comment  === "" )  $err_msg2 = "コメントを入力してください";

        if( $err_msg1 === "" && $err_msg2 ==="" ){
             $DBSERVER = 'localhost';
             $DBNAME = 'board';
             $DBUSER = 'hotty'; //作成したユーザー名
             $DBPASSWD = 'hotta'; //作成したユーザーのパスワード
             $dsn = "mysql:host={$DBSERVER};dbname={$DBNAME};charset=utf8';
             $pdo = new \PDO($dsn, $DBUSER, $DBPASSWD, array(\PDO::ATTR_EMULATE_PREPARES => false));
    }

}
 $sql = 'INSERT INTO `board` (name, comment, created) VALUES (:name, :name, :comment, NOW())';
 $stmt = $pdo->prepare($sql);
 $stmt->bindValue(':name', $name, \PDO::PARAM_STR);
 $stmt->bindValue(':comment', $comment, \PDO::PARAM_STR);
 $stmt->execute();

読み込みはこうです
code: select.php
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
        <dl>
         　　<?php foreach( $dataArr as $data ):?>
         　　　　<p><span><?php echo $data["name"]; ?></span>:<span><?php echo $data["comment"]; ?></span></p>
        　　 <?php endforeach;?>
　　　　　</dl>
    </body>
</html>