<?php
require 'password.php';   // password_verfy()��php 5.5.0�ȍ~�̊֐��̂��߁A�o�[�W�������Â��Ďg���Ȃ��ꍇ�Ɏg�p
// �Z�b�V�����J�n
session_start();

$db['host'] = "localhost";  // DB�T�[�o��URL
$db['user'] = "hogeUser";  // ���[�U�[��
$db['pass'] = "hogehoge";  // ���[�U�[���̃p�X���[�h
$db['dbname'] = "loginManagement";  // �f�[�^�x�[�X��

// �G���[���b�Z�[�W�̏�����
$errorMessage = "";

// ���O�C���{�^���������ꂽ�ꍇ
if (isset($_POST["login"])) {
    // 1. ���[�UID�̓��̓`�F�b�N
    if (empty($_POST["userid"])) {  // empty�͒l����̂Ƃ�
        $errorMessage = '���[�U�[ID�������͂ł��B';
    } else if (empty($_POST["password"])) {
        $errorMessage = '�p�X���[�h�������͂ł��B';
    }

    if (!empty($_POST["userid"]) && !empty($_POST["password"])) {
        // ���͂������[�UID���i�[
        $userid = $_POST["userid"];

        // 2. ���[�UID�ƃp�X���[�h�����͂���Ă�����F�؂���
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

        // 3. �G���[����
        try {
            $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            $stmt = $pdo->prepare('SELECT * FROM userData WHERE name = ?');
            $stmt->execute(array($userid));

            $password = $_POST["password"];

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($password, $row['password'])) {
                    session_regenerate_id(true);

                    // ���͂���ID�̃��[�U�[�����擾
                    $id = $row['id'];
                    $sql = "SELECT * FROM userData WHERE id = $id";  //���͂���ID���烆�[�U�[�����擾
                    $stmt = $pdo->query($sql);
                    foreach ($stmt as $row) {
                        $row['name'];  // ���[�U�[��
                    }
                    $_SESSION["NAME"] = $row['name'];
                    header("Location: Main.php");  // ���C����ʂ֑J��
                    exit();  // �����I��
                } else {
                    // �F�؎��s
                    $errorMessage = '���[�U�[ID���邢�̓p�X���[�h�Ɍ�肪����܂��B';
                }
            } else {
                // 4. �F�ؐ����Ȃ�A�Z�b�V����ID��V�K�ɔ��s����
                // �Y���f�[�^�Ȃ�
                $errorMessage = '���[�U�[ID���邢�̓p�X���[�h�Ɍ�肪����܂��B';
            }
        } catch (PDOException $e) {
            $errorMessage = '�f�[�^�x�[�X�G���[';
            //$errorMessage = $sql;
            // $e->getMessage() �ŃG���[���e���Q�Ɖ\�i�f�o�b�O���̂ݕ\���j
            // echo $e->getMessage();
        }
    }
}
?>

<!doctype html>
<html>
    <head>
            <meta charset="UTF-8">
            <title>���O�C��</title>
    </head>
    <body>
        <h1>���O�C�����</h1>
        <form id="loginForm" name="loginForm" action="" method="POST">
            <fieldset>
                <legend>���O�C���t�H�[��</legend>
                <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
                <label for="userid">���[�U�[ID</label><input type="text" id="userid" name="userid" placeholder="���[�U�[ID�����" value="<?php if (!empty($_POST["userid"])) {echo htmlspecialchars($_POST["userid"], ENT_QUOTES);} ?>">
                <br>
                <label for="password">�p�X���[�h</label><input type="password" id="password" name="password" value="" placeholder="�p�X���[�h�����">
                <br>
                <input type="submit" id="login" name="login" value="���O�C��">
            </fieldset>
        </form>
        <br>
        <form action="SignUp.php">
            <fieldset>          
                <legend>�V�K�o�^�t�H�[��</legend>
                <input type="submit" value="�V�K�o�^">
            </fieldset>
        </form>
    </body>
</html>