
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>sample</title>
</head>
<body>
<form action="VideoComment.php" enctype="multipart/form-data" method="post">
    {$message}<br/>
    {$videoname}<br/>
    <video id =video src='{$target}' width='426' height='240'></video>
    <br/>
    <input type='button' value='play' onclick='video_play()'>
    <input type='button' value='pause' onclick='video_pause()'>
    <br/>
    <input type='hidden' name='videoId' value='{$videoId}'>
    <input type="submit" value="この動画にコメントする" />
</form>


<div class="contents" id="output"></div>

<li><a href="VideoUpload.php">アップロード画面へ</a></li>
<li><a href="VideoList.php">動画一覧へ</a></li>
</body>
</html>
