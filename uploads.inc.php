<?php

date_default_timezone_set('Asia/Tokyo');

// MySQLのホスト名
$DBSERVER = "localhost";
// データベース名
$DBNAME = "board";
// MySQLのユーザー名
$DBUSER = "hotty";
// MySQLパスワード
$DBPASSWD = "hotta";

ini_set('display_errors', "On");

require_once __DIR__ . '/loader.php';