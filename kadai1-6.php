<?php
    session_start();
?>

<html>
<head><title>PHP TEST</title></head>
<body>

<?php

    if (!isset($_SESSION["visited"])){
        print('初回の訪問です。セッションを開始します。');
        $_SESSION["visited"] = 1;
    }else{
        $visited = $_SESSION["visited"];
        $visited++;

        print('訪問回数は'.$visited.'です。<br>');

        $_SESSION["visited"] = $visited;
    }

?>

</body>
</html>