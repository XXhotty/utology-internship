<?php
/**
 *MySQLの接続の為のクラス
 *Class for connecting MySQL
 */
class DB
{
    /*
    *コンストラクタ
    *@var host:ホスト
    *@var user:ユーザー
    *@var pass:パス
    *@var db:データーベース名
    */
    function __construct($host,$user,$pass,$db)
    {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->db = $db;
        $this->dsn = "mysql:dbname=$db;$host=$host";
    }


    function fetch($sql)
    {
        try{
            $pdo = new PDO ($this->dsn, $this->user, $this->pass, array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch(PDOException $ei) {
            echo 'Connection failed:'.$e->getMessage();
            exit();}
    }

    function execute ($sql)
    {
        try{
            $pdo = new PDO ($this->dsn, $this->user, $this->pass, array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $data = $pdo->lastInsertId();
            return $data;
        } catch(PDOException $ei) {
            echo 'Connection failed:'.$e->getMessage();
            exit();}
    }

}