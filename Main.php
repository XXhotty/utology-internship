<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}

include_once __DIR__ . '/libs/Smarty.class.php';

// smartyを宣言して設定を書き加えます
$smarty = new Smarty();
$smarty->escape_html = true;
$smarty->template_dir = __DIR__ . '/templates';
$smarty->compile_dir = __DIR__ . '/templates_c';


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


$err_msg = 'test';

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




$smarty->assign('err_msg', $err_msg);
$smarty->assign('messages', $messages);
$smarty->display('main.tpl');

