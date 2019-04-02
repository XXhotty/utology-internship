<?php
namespace libs\dao;

//use libs\entity\UploadsEntity;

class UploadsDao extends Database
{
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

    function word ($word)
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

    function mp4()
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