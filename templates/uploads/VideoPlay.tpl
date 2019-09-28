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

<div style="backGround-color: rgba(255,255,255,0); position: relative; top: -290px; left: 52px;">
    <div id="area" class="area">
        <div id="area1" ></div>
        <div id="area2"></div>
        <div id="area3"></div>
        <div id="area4"></div>
        <div id="area5"></div>
    </div>
</div>
    <!--
<div id="area1" class="area">
    <a></a>
</div>
<div id="area2" class="area">
    <a></a>
</div>
<div id="area3" class="area">
    <a></a>
</div>
<div id="area4" class="area">
    <a></a>
</div>
<div id="area5" class="area">
    <a></a>
</div>
-->

<div id="response0"></div>
<div id="response1"></div>
<div id="response2"></div>

</body>
</html>
