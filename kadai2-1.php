<?php
//var_dump($_POST);
//�ŏ��ɕϐ����`���Ă����Ȃ��ƃG���[�ɂȂ�
$err_msg1 = "";
$err_msg2 = "";
$message ="";
$name = ( isset( $_POST["name"] ) === true ) ?$_POST["name"]: "";
$comment  = ( isset( $_POST["comment"] )  === true ) ?  trim($_POST["comment"])  : "";
 
//���e������ꍇ�̂ݏ������s��
if (  isset($_POST["send"] ) ===  true ) {
    if ( $name   === "" ) $err_msg1 = "���O����͂��Ă�������"; 
 
    if ( $comment  === "" )  $err_msg2 = "�R�����g����͂��Ă�������";
 
    if( $err_msg1 === "" && $err_msg2 ==="" ){
        $fp = fopen( "data.txt" ,"a" );
        fwrite( $fp ,  $name."\t".$comment."\n");
        $message ="�������݂ɐ������܂����B";
    }
 
}
 
$fp = fopen("data.txt","r");
 
$dataArr= array();
while( $res = fgets( $fp)){
    $tmp = explode("\t",$res);
    $arr = array(
        "name"=>$tmp[0],
        "comment"=>$tmp[1]
    );
    $dataArr[]= $arr;
} 
 
 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>�f����</title>
    </head>
    <body>
        <?php echo $message; ?>
        <form method="post" action="">
        ���O�F<input type="text" name="name" value="<?php echo $name; ?>" >
            <?php echo $err_msg1; ?><br>
            �R�����g�F<textarea  name="comment" rows="4" cols="40"><?php echo $comment; ?></textarea>
            <?php echo $err_msg2; ?><br>
<br>
          <input type="submit" name="send" value="�N���b�N" >
        </form>
        <dl>
         �@�@<?php foreach( $dataArr as $data ):?>
         �@�@�@�@<p><span><?php echo $data["name"]; ?></span>:<span><?php echo $data["comment"]; ?></span></p>
        �@�@ <?php endforeach;?>
�@�@�@�@�@</dl>
    </body>
</html>