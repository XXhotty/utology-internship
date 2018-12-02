<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
    名前<input type="text" name="name" value="" />
    コメント<textarea name="comment" rows="4" cols="20"></textarea>
    <input type="submit" name="send" value="書き込む" />
</form>
<!-- ここに、書き込まれたデータを表示する -->
<?php
if ( $msg     !== '' ) echo '<p>' . $msg . '</p>';
if ( $err_msg !== '' ) echo '<p style="color:#f00;">' . $err_msg . '</p>';
foreach( $data as $key => $val ){
    echo $val['name'] . ' ' . $val['comment'] . '<br>';
}
?>
</body>
</html>