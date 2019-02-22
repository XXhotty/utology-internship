<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>動画一覧</title>
</head>
<body>
<form action="4-3.php" enctype="multipart/form-data" method="post">
    {foreach from=$result item=mp}
        <input type='submit' value='{$mp['title']}:この動画を見る' name='sub'>
        <br/>
    {/foreach}
</form>
<li><a href="4-1.php">アップロード画面へ</a></li>
</body>
</html>

