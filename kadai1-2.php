<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>フォームからPOSTで送信されたデータを表示 数字限定</title>
</head>
<body>
<form method="POST" action="kadai1-2.php">

<?php
if (ctype_digit($onemae)) {
	 echo $_POST["onamae"] ."";
    }
?>

<br />
<label>数字を入力してください：</label>
<input type="text" name="onamae" /><br />
<input type="submit" value="送信" />
</form>
</body>
</html>