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
<form action="3-11.php" enctype="multipart/form-data" method="post">

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
    $sql = "SELECT * FROM mp4 ORDER BY id;";
    $stmt = $pdo->prepare($sql);
    $stmt -> execute();
    while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
        echo ($row["name"]."<br/>");
        $target = "files/".$row["name"];

        echo ("<video id =video src=\"$target\" width=\"426\" height=\"240\" controls></video>");
        }
    echo ("<br/><br/>");
?>

</form>
<li><a href="3-9.php">アップロード画面へ</a></li>
</body>
</html>