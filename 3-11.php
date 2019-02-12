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


$name     = $_POST['name'];
$title = explode(":",$name);

$sql = "SELECT * FROM mp4 ORDER BY id;";
$stmt = $pdo->prepare($sql);
$stmt -> execute();
while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
    if ($row["title"] == $title[0]) {
        echo("<input type=\"hidden\" name=\"name\" value=\"$name\">");
        echo($row["name"] . "<br/>");
        $target = "files/" . $row["name"];
        echo("<video id =video src=\"$target\" width=\"426\" height=\"240\" controls></video>");
    }
}


