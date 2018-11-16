 $sql = 'SELECT * FROM `board`';
 $stmt = $pdo->prepare($sql);
 $stmt->execute();
 $messages = $stmt->fetchAll();