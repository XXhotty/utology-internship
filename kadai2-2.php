<?php

$DBSERVER = 'localhost';
$DBNAME = 'board';
$DBUSER = 'board'; //作成したユーザー名
$DBPASSWD = 'pw'; //作成したユーザーのパスワード
$dsn = 'mysql:host={$DBSERVER};dbname={$DBNAME};charset=utf8';
$pdo = new \PDO($dsn, $DBUSER, $DBPASSWD, array(\PDO::ATTR_EMULATE_PREPARES => false));

if ( $pdo !== false ) {

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
    $msg = $stmt->fetchAll();

} else {
    echo "データベースの接続に失敗しました";
}
// smarty のライブラリを読み込みます
include_once __DIR__ . '/libs/smarty.class.php';

// smartyを宣言して設定を書き加えます
$smarty = new Smarty();
$smarty->escape_html = true;
$smarty->template_dir = __DIR__ . '/templates';
$smarty->compile_dir = __DIR__ . '/templates_c';

$smarty->display('kadai2-2.tpl');