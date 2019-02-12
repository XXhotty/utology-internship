<?php

// smarty のライブラリを読み込みます
include_once __DIR__ . '/libs/Smarty.class.php';
// smartyを宣言して設定を書き加えます
$smarty = new Smarty();
$smarty->escape_html = true;
$smarty->template_dir = __DIR__ . '/templates';
$smarty->compile_dir = __DIR__ . '/templates_c';

try {
    $user = "hotty";
    $pass = "hotta";
    $pdo = new PDO("mysql:host=localhost;dbname=board;charset=utf8", $user, $pass);

}
catch(PDOException $e){
    echo("<p>500 Inertnal Server Error</p>");
    exit($e->getMessage());
}
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>sample</title>
</head>
<body>
<form method="POST" action="">

    a.<br/>
    <?php
    try {
        $user = "hotty";
        $pass = "hotta";
        $pdo = new PDO("mysql:host=localhost;dbname=board;charset=utf8", $user, $pass);
    }
    catch(PDOException $e){
        echo("<p>500 Inertnal Server Error</p>");
        exit($e->getMessage());
    }
    $name = 1;
    $created = 1;

    $sql = 'INSERT INTO `mp4` (name, created) VALUES (:name, :created)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', $name, \PDO::PARAM_STR);
    $stmt->bindValue(':created', $created, \PDO::PARAM_STR);
    $stmt->execute();

    echo("a.<br/>");
    $sql = "SELECT * FROM mp4 ORDER BY id;";
    $stmt = $pdo->prepare($sql);
    $stmt -> execute();
    while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
        echo ($row["id"]."<br/>");
        $target = "files/".$row["name"];
        echo ($target."<br/>");

        echo ("<video id =video src=\"$target\" width=\"426\" height=\"240\" controls></video>");
        }
    echo ("<br/><br/>");
    echo ("<video id =video src=\"files/me.mp4\" width=\"426\" height=\"240\" controls></video>");

?>

</form>
</body>
</html>