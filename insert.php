 $sql = 'INSERT INTO `board` (name, comment, created) VALUES (:name, :name, :comment, NOW())';
 $stmt = $pdo->prepare($sql);
 $stmt->bindValue(':name', $name, \PDO::PARAM_STR);
 $stmt->bindValue(':comment', $comment, \PDO::PARAM_STR);
 $stmt->execute();