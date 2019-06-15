<!DOCTYPE html>
<html lang="ja">
<head>

    {include file='../../templates/uploads/VideoHeader.tpl'}

    <link rel="stylesheet" href="../assets/css/VideoHeader.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>動画一覧</title>
</head>
<body>
<form action="" method="post">
    <input type="text" name="word">
    <input type="submit" value="検索">
</form>

    {foreach from=$result item=mp}
<form action="VideoPlay.php" enctype="multipart/form-data" method="post">
    <input type="hidden" name="videoId" value="{$mp['id']}">
        <input type='submit' value='{$mp['title']}:この動画を見る' name='sub'>
</form>

    {/foreach}

</body>
</html>

