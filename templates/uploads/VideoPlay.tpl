<!DOCTYPE html>
<html lang="ja">
<head>
    {include file='../../templates/uploads/VideoHeader.tpl'}

    <link rel="stylesheet" href="../assets/css/VideoHeader.css">
    <link rel="stylesheet" href="../assets/css/VideoPlay.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>動画再生</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/VideoPlay.js"></script>

</head>
<body>
<div id="videoId" style="display: none">{$videoId}</div>
<div id="Jcomments" style="display: none">{$Jcomments nofilter}</div>
    {$message}<br/>
    {$videoName}<br/>
    <video id =video src='{$target}' width='426' height='240'></video>
    <br/>
    <input type='button' value='play' id='video_play'>
    <input type='button' value='pause' id='video_pause'>
    <br/>
    コメント:<input type="text" id="comment">
    <input type="button" value="コメントする" onclick='comment_ajax()' >

    <div id="space1" class="area"></div>
    <div id="space2" class="area"></div>
    <div id="space3" class="area"></div>

<div id="response0"></div>
<div id="response1"></div>
<div id="response2"></div>

</body>
</html>
