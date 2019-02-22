
<h1>アップロード画面</h1>

<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>media</title>
</head>


<body>
<p>{$messages}</p>
<form action="4-1.php" enctype="multipart/form-data" method="post">
    <label>動画アップロード</label>
    <br/>
    タイトル:<input type="text" name="title" value="" />
    <input type="file" name="upfile">
    <br>
    ※動画はmp4方式のみ対応しています．<br>
    <input type="submit" name="send" value="アップロード">
</form>

<li><a href="4-2.php">動画一覧へ</a></li>
</body>
</html>