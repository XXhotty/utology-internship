
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>sample</title>
</head>
<body>
<form action="" enctype="multipart/form-data" method="post" name="form">
    {$message}<br/>
    {$videoname}<br/>
    <video id =video src='{$target}' width='426' height='240'></video>
    <br/>
    <input type='button' value='play' onclick='video_play()'>
    <input type='button' value='pause' onclick='video_pause()'>
    <br/>
    コメント:<textarea name="comment" rows="1" cols="20"></textarea>
    <input type="button" value="コメントする" onclick='comment_ajax()' >
</form>


<div class="contents" id="output"></div>

<li><a href="VideoUpload.php">アップロード画面へ</a></li>
<li><a href="VideoList.php">動画一覧へ</a></li>

<div id="response0"></div>
<div id="response1"></div>
<div id="response2"></div>

</body>
</html>
