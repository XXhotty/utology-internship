 $DBSERVER = 'localhost';
 $DBNAME = 'board';
 $DBUSER = 'board'; //�쐬�������[�U�[��
 $DBPASSWD = 'pw'; //�쐬�������[�U�[�̃p�X���[�h
 $dsn = "mysql:host={$DBSERVER};dbname={$DBNAME};charset=utf8';
 $pdo = new \PDO($dsn, $DBUSER, $DBPASSWD, array(\PDO::ATTR_EMULATE_PREPARES => false));