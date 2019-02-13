
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>sample</title>
</head>
<body>
<form action="3-12.php" enctype="multipart/form-data" method="post">
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
        $pdo2 = new PDO("mysql:host=localhost;dbname=board;charset=utf8", $user, $pass);
    } catch (PDOException $e) {
        echo("<p>500 Inertnal Server Error</p>");
        exit($e->getMessage());
    }


    if (isset($_POST["sub"])) {
        $sub = $_POST["sub"];
        $title = explode(":", $sub);

        $comment = array("");
        $time = array("");
        $sql2 = "SELECT * FROM videocomment ORDER BY id;";
        $stmt2 = $pdo2->prepare($sql2);
        $stmt2->execute();
        $num = 0;
        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            if ($row2["name"] == $title[0]) {
                $num++;
                array_push($comment, $row2[comment]);
                array_push($time, $row2[time]);
            }
        }

        $sql = "SELECT * FROM mp4 ORDER BY id;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($row["title"] == $title[0]) {
                echo("<input type=\"hidden\" name=\"name\" value=\"$name\">");
                echo($title[0] . "<br/>");
                $target = "files/" . $row["name"];
                echo("<video id =video src=\"$target\" width=\"426\" height=\"240\"></video>");
                echo("<br/>");
                echo("<input type='button' value='play' onclick='video_play($comment,$time)'>");
                echo("<input type='button' value='pause' onclick='video_pause()'>");
                echo("<br/>");
                echo("<input type=\"hidden\" name=\"title\" value=\"$title[0]\">");
            }
        }
    } else {
        echo("動画一覧画面で動画を選択してください");
    }


?>
    <input type="submit" value="この動画にコメントする" />
</form>

<script type="text/javascript">
    var count = 0;


    window.onload = function() {
        target = document.getElementById("output");
    };
    function video_play(array1,array2) {
        empty = "コメントなし";
        video.play();
        var countup = function(){
            console.log(count++);
            len = array1.length;
            len++;
            for (var i = 0; i < len; i++){
                if(array2[i] = count){
                    target.innerHTML = array1[i];
                }
                else{
                    target.innerHTML = empty;
                }
            }
        };
        I = setInterval(countup, 1000);
    }
    function video_pause() {
        video.pause();
        clearInterval(I);
    }
</script>
<div class="contents" id="output"></div>

<li><a href="3-9.php">アップロード画面へ</a></li>
<li><a href="3-10.php">動画一覧へ</a></li>
</body>
</html>
