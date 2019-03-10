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

    /**
     * @param $name
     * @param $title
     * @return null
     */
    function create ($name, $title)
    {
        try {
            $sql = 'INSERT INTO `mp4` (name, title, created) VALUES (:name,:title, NOW())';
            $pdo = new PDO("mysql:host=$this->host;dbname=$this->db;charset=utf8", $this->user, $this->pass);
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':name', $name, \PDO::PARAM_STR);
            $stmt->bindValue(':title', $title, \PDO::PARAM_STR);
            $stmt->execute();
            return null;
        }catch(PDOException $ei) {
            echo 'Connection failed:'.$e->getMessage();
            exit();}
    }


    /**
     * @param $videoname
     * @param $comment
     * @param $time
     * @return null
     */
    function comment ($videoId, $comment, $time)
    {
        try {
            $sql = 'INSERT INTO `videocomment` (videoId, comment, time) VALUES (:videoId,:comment, :time)';
            $pdo = new PDO("mysql:host=$this->host;dbname=$this->db;charset=utf8", $this->user, $this->pass);
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':videoId', $videoId, \PDO::PARAM_STR);
            $stmt->bindValue(':comment', $comment, \PDO::PARAM_STR);
            $stmt->bindValue(':time', $time, \PDO::PARAM_STR);
            $stmt->execute();
            return null;
        }catch(PDOException $ei) {
            echo 'Connection failed:'.$e->getMessage();
            exit();}
    }

    /**
     * @param $word
     * @return array
     */
    function word ($word)
    {
        try {
            //$sql = "SELECT * FROM mp4 WHERE title LIKE N'%$word%';";
            $sql = "SELECT * FROM mp4 WHERE title LIKE (:word)";
            $pdo = new PDO("mysql:host=$this->host;dbname=$this->db;charset=utf8", $this->user, $this->pass);
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':word', "%{$word}%", \PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }catch(PDOException $ei) {
            echo 'Connection failed:'.$e->getMessage();
            exit();}
    }

    function mp4()
    {
        try{
            $pdo = new PDO ($this->dsn, $this->user, $this->pass, array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
            $sql = "SELECT * FROM mp4 ORDER BY id;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch(PDOException $ei) {
            echo 'Connection failed:'.$e->getMessage();
            exit();}
    }

}