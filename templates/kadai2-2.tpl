﻿<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<form method="post" action="">
    名前<input type="text" name="name" value="" />
    コメント<textarea name="comment" rows="4" cols="20"></textarea>
    <input type="submit" name="send" value="書き込む" />
</form>
<!-- ここに、書き込まれたデータを表示する -->

<p>{$err_msg}<p/>


foreach ({$messages} as &{$message}) {
    <p>{$message['name']}:{$message['comment']}.{$message['created']}<p/>
}
?>
</body>

</body>