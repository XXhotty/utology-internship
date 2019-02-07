<?php
$updir = "./upload/";
$filename = $_FILES['upfile']['name'];
if(move_uploaded_file($_FILES['upfile']['tmp_name'], $updir.$filename)==FALSE){
    print("Upload failed");
    print($_FILES['upfile']['error']);
}
else {
    print("<b> $filename </b> uploaded");
}
?>

<html>
<head><title>uploader.html</title></head>
<body>
<form method="post" enctype="multipart/form-data" action="3-9.php">
    <input type="file" name="upfile">
    <input type="submit" value="アップロードする">
</form>
</body>
</html>


