<!DOCTYPE html>
<html lang="ja">
<h1>アップロード画面</h1>
<head>
    {include file='../../templates/uploads/VideoHeader.tpl'}

    <link rel="stylesheet" href="../assets/css/VideoHeader.css">
    <meta charset="utf-8">
    <title>動画アップロード</title>
</head>


<body>
<p>{$messages}</p>
<form action="" enctype="multipart/form-data" method="post">
    <label>動画アップロード</label>
    <br/>
    タイトル:<input type="text" name="title" value="" />
    <input type="file" name="upfile">
    <br>
    ※動画はmp4方式のみ対応しています．<br>
    <input type="submit" name="send" value="アップロード">
</form>

</body>
</html>