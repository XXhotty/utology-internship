<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>sample</title>
</head>
<body>
<form method="POST" action="">


    <?php
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

?>

</form>
</body>
</html>