<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>動画一覧</title>
</head>
<body>
<form action="" method="post">
    <input type="text" name="word">
    <input type="submit" value="検索">
</form>
<form action="VideoPlay.php" enctype="multipart/form-data" method="post">
    {foreach from=$result item=mp}
        <input type='submit' value='{$mp['id']}.{$mp['title']}:この動画を見る' name='sub'>
        <br/>
    {/foreach}
</form>
<li><a href="VideoUpload.php">アップロード画面へ</a></li>
</body>
</html>

