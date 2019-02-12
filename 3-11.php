
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>sample</title>
</head>
<body>
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


if (isset($_POST["sub"])) {
    $sub = $_POST["sub"];
    $title = explode(":", $sub);
    $sql = "SELECT * FROM mp4 ORDER BY id;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($row["title"] == $title[0]) {
            echo("<input type=\"hidden\" name=\"name\" value=\"$name\">");
            echo($row["name"] . "<br/>");
            $target = "files/" . $row["name"];
            echo("<video id =video src=\"$target\" width=\"426\" height=\"240\"></video>");
            echo("<br/>");
            echo ("<input type='button' value='play' onclick='video_play()'>");
            echo ("<input type='button' value='pause' onclick='video_pause()'>");
            echo("<br/>");

        }
    }
}
else{
    echo("動画一覧画面で動画を選択してください");
}
?>

<script type="text/javascript">
    var count = 0;

    function video_play() {
        video.play();
        var countup = function(){
            console.log(count++);
        }
        I = setInterval(countup, 1000);
    }
    function video_pause() {
        video.pause();
        clearInterval(I);
    }
</script>

<li><a href="3-10.php">動画一覧へ</a></li>
</body>
</html>
