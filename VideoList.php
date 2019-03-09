<?php
include_once __DIR__ . '/libs/Smarty.class.php';
$smarty = new Smarty();
$smarty->escape_html = true;
$smarty->template_dir = __DIR__ . '/templates';
$smarty->compile_dir = __DIR__ . '/templates_c';

require_once __DIR__ . '/libs/dao/AccessDao.php';
$db = new DB(localhost,hotty,hotta,board);

if(isset($_POST["word"])){
    $word = $_POST["word"];
    try{
        $pdo = new PDO ($this->dsn, $this->user, $this->pass, array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
        $sql = "SELECT * FROM mp4 WHERE title LIKE :word";
        $stmt->bindValue(':word', "N'%{$word}%'", \PDO::PARAM_STR);
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $data = $pdo->lastInsertId();
        return $data;
    } catch(PDOException $ei) {
        echo 'Connection failed:'.$e->getMessage();
        exit();}

    $result = $data;
}else{
    $sql = "SELECT * FROM mp4 ORDER BY id;";
    $result = $db->fetch($sql);
}
$smarty->assign('result', $result);
$smarty->display('VideoList.tpl');

