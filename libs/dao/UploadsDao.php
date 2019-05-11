<?php
namespace libs\dao;
use \PDO;
use \PDOException;
//use libs\entity\UploadsEntity;

class UploadsDao extends Database
{


    /**
     * @param $videoname
     * @param $comment
     * @param $time
     * @return null
     */
    public function commentWrite ($videoId, $comment, $time)
    {
        try {
            $sql = 'INSERT INTO `videocomment` (videoId, comment, time) VALUES (:videoId,:comment, :time)';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':videoId', $videoId, \PDO::PARAM_STR);
            $stmt->bindValue(':comment', $comment, \PDO::PARAM_STR);
            $stmt->bindValue(':time', $time, \PDO::PARAM_STR);
            $stmt->execute();
            return null;
        }catch(PDOException $ei) {
            echo 'Connection failed:'.$e->getMessage();
            exit();}
    }

    public function commentGet()
    {
        try{
            $sql = "SELECT * FROM videocomment ORDER BY cast(time as signed);;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch(PDOException $ei) {
            echo 'Connection failed:'.$e->getMessage();
            exit();}
    }

    public function commentGetByVideoId($videoId)
    {
        try{
            $sql = "SELECT * FROM videocomment WHERE videoId = :videoId ORDER BY cast(time as signed);";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':videoId', $videoId);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch(PDOException $ei) {
            echo 'Connection failed:'.$e->getMessage();
            exit();}
    }

    public function videoGet()
    {
        try{
            $sql = "SELECT * FROM mp4 ORDER BY id;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    public function create($name, $title)
    {
        $sql = 'INSERT INTO `mp4` (name, title, created) VALUES (:name,:title, NOW())';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':name', $name, \PDO::PARAM_STR);
        $stmt->bindValue(':title', $title, \PDO::PARAM_STR);
        $stmt->execute();
        return null;
    }

    public function word ($word)
    {
        try {
            $sql = "SELECT * FROM mp4 WHERE title LIKE (:word)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':word', "%{$word}%", \PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }catch(PDOException $ei) {
            echo 'Connection failed:'.$e->getMessage();
            exit();}
    }


    public function mp4()
    {
        try{
            $sql = "SELECT * FROM mp4 ORDER BY id;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch(PDOException $ei) {
            echo 'Connection failed:'.$e->getMessage();
            exit();}
    }

}