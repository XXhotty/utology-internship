<html>
<head>
    <meta charset="UTF-8">
    <title>メイン</title>
</head>
<body>
<h1>メイン画面</h1>
<!-- ユーザーIDにHTMLタグが含まれても良いようにエスケープする -->
<p>ようこそ<u>{$nickname}</u>さん</p>  <!-- ユーザー名をechoで表示 -->
<ul>
    <li><a href="Logout.php">ログアウト</a></li>
</ul>
<form method="post" action="">
    名前<input type="text" name="name" value="" />
    コメント<textarea name="comment" rows="4" cols="20"></textarea>
    <input type="submit" name="send" value="書き込む" />
</form>
<!-- ここに、書き込まれたデータを表示する -->

<p>{$err_msg}</p>


{foreach from=$messages item=message}
    <p>{$message['name']}:{$message['comment']}.{$message['created']}</p>
{/foreach}
</body>