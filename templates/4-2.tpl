<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>sample</title>
</head>
<body>
<form action="4-3.php" enctype="multipart/form-data" method="post">
    {foreach from=$result item=result}
        <input type='submit' value='{$result['title']}:この動画を見る' name='sub'>
    {/foreach}
</form>
<li><a href="4-1.php">アップロード画面へ</a></li>
</body>
</html>

