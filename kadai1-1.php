<form method="POST" action="kakunin.php">
<input type="text" name="name">
<?php 
   $input_data = $_POST['name'];
if ($input_data = $_POST['name']) {
    echo ("<input type='text' size='8' name='name1' value='$input_data'>");
}else{
    echo ("<input type='text' size='8' name='name1' value='未入力'>");
}