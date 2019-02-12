
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>sample</title>
</head>
<body>
<form method="post" action="">
    時間:<input type="text" name="time" value="" />秒地点
    コメント:<textarea name="comment" rows="4" cols="20"></textarea>
    <input type="submit" name="send" value="書き込む" />
    <?php
    $title = $_POST["title"];
    echo("<input type=\"hidden\" name=\"title\" value=\"$title\">");
    ?>
    </form>
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


if (isset($_POST["title"])) {
    $name = $_POST["title"];
    $comment = $_POST['comment'];
    $created = $_POST['time'];
    if ($name !== '' && $comment !== '' && $created !== '') {
        $sql = 'INSERT INTO `videocomment` (name, comment, created) VALUES (:name,:title, :created)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $name, \PDO::PARAM_STR);
        $stmt->bindValue(':comment', $comment, \PDO::PARAM_STR);
        $stmt->bindValue(':created', $created, \PDO::PARAM_STR);
        $stmt->execute();
    }
    else{
        echo("時間とコメントを入力してください");
    }
}
else{
    echo("動画一覧画面で動画を選択してください");
}
?>

<li><a href="3-9.php">アップロード画面へ</a></li>
<li><a href="3-10.php">動画一覧へ</a></li>
</body>
</html>
