<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>フォームからPOSTで送信されたデータを表示 - サンプル1 - PHP入門</title>
</head>
<body>
<form method="POST" action="kadai1-2.php">

<?php
  echo $_POST["onamae"] ."";
?>

<br />
<label>文字を入力してください：</label>
<input type="text" name="onamae" /><br />
<input type="submit" value="送信" />
</form>
</body>
</html>