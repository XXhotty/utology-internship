<?php
namespace libs\dao;
abstract class Database
{
    protected $pdo;
    public function __construct()
    {
        try {
            global $DBSERVER, $DBUSER, $DBPASSWD, $DBNAME;
            $dsn = 'mysql:'
                . 'host=' . $DBSERVER . ';'
                . 'dbname=' . $DBNAME . ';'
                . 'charset=utf8';
            $this->pdo = new \PDO($dsn, $DBUSER, $DBPASSWD, array(\PDO::ATTR_EMULATE_PREPARES => false));
        } catch (\Exception $e) {
            throw $e;
        }
    }
}