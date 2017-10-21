<?php
require_once 'config.php';
class Db
{

    private static $instance = null;

    private function __construct()
    {}

    private function __clone()
    {}

    public static function getInstance()
    {
        $servername = DB_HOST;
        $username   = DB_USER;
        $password   = DB_PASSWORD;
        $dbname     = DB_NAME;
        if (!isset(self::$instance)) {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            self::$instance                 = new PDO('mysql:host=' . $servername . ';dbname=' . $dbname, $username, $password, $pdo_options);
        }
        return self::$instance;
    }
}
