<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ファイルから書き込み</title>
</head>
<body>
<form method="POST" action="kadai1-4-2.php">

<br />
<label>文字を入力してください：</label>
<input type="text" name="onamae" /><br />
<input type="submit" value="送信" />
<?php
// ファイルを開く
$fp = fopen("file-sample.txt", "w") or die("ファイルが開けないよぉ！");
 
// ファイルへ書き込み
fwrite($fp, "==== ==== ==== ==== ====\n");
fwrite($fp,$_POST["onamae"] ."w");
fwrite($fp, "==== ==== ==== ==== ====\n");
 
// ファイルを閉じる
fclose($fp);
?>
</form>
</body>
</html>