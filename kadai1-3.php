<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>フォームからPOSTで送信されたデータを表示 検索</title>
</head>
<body>
<form method="POST" action="kadai1-3.php">

<?php
if (strpos($_POST["onamae"],'php') !== false) {
	 echo $_POST["onamae"] ."";
    }
?>

<br />
<label>文字列を入力してください：</label>
<input type="text" name="onamae" /><br />
<input type="submit" value="送信" />
</form>
</body>
</html>