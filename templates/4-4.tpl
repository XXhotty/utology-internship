<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>コメント</title>
</head>
<body>
<form method="post" action="">
    時間:<input type="text" name="time" value="" />秒地点
    コメント:<textarea name="comment" rows="4" cols="20"></textarea>
    <input type="submit" name="send" value="書き込む" />
    <input type='hidden' name='videoname' value='{$videoname}'>
    <br/>
    {$message}
</form>
<li><a href="4-1.php">アップロード画面へ</a></li>
<li><a href="4-2.php">動画一覧へ</a></li>
</body>
</html>