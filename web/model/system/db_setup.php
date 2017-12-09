<?php

class dbSetup
{

    // database object
    private static $dbInstance = null;

    public $dbConn = null;
    /* set database settings here! */
    // PDO database type
    public $dbtype = 'mysql';
    // PDO database name
    public $dbname = 'shingnan';
    // PDO database host
    public $dbhost = '127.0.0.1';
    // PDO database username
    public $dbuser = 'shingnan';
    // PDO database password
    public $dbpass = 'uscclab';

    private function __construct()
    {
        // instantiate the pdo object
        try {
            $dsn     = "{$this->dbtype}:host={$this->dbhost};dbname={$this->dbname};charset=utf8";
            $options = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            );
            $this->dbConn = new PDO($dsn, $this->dbuser, $this->dbpass, $options);
        } catch (PDOException $e) {
            print 'Error!: ' . $e->getMessage();
            die();
        }
    }

    private static function getDBInstance()
    {
        if (self::$dbInstance == null) {
            self::$dbInstance = new dbSetup();
        }

        return self::$dbInstance;
    }

    public static function getDbConn()
    {
        try {
            $db = self::getDBInstance();
            return $db->dbConn;
        } catch (Exception $ex) {
            echo 'I was unable to open a connection to the database. ' . $ex->getMessage();
            return null;
        }
    }
}
