<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>�t�H�[������POST�ő��M���ꂽ�f�[�^��\�� ����</title>
</head>
<body>
<form method="POST" action="kadai1-3.php">

<?php
if (strpos($_POST["onamae"],'php') !== false) {
	 echo $_POST["onamae"] ."";
    }
?>

<br />
<label>���������͂��Ă��������F</label>
<input type="text" name="onamae" /><br />
<input type="submit" value="���M" />
</form>
</body>
</html>