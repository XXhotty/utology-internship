<?php
namespace libs\dao;

use libs\entity\UploadEntity;

echo("a.<br/>");
class UploadDao extends Database
{
    /**
     * @param $name
     * @param $title
     * @return null
     */
    public function create($name, $title)
    {
        echo("$name");
        $sql = 'INSERT INTO `mp4` (name, title, created) VALUES (:name,:title, NOW())';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':name', $name, \PDO::PARAM_STR);
        $stmt->bindValue(':title', $title, \PDO::PARAM_STR);
        $stmt->execute();
        return null;
    }
}