<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../config/databaseConn.php";
class connection{
    public $servername = "localhost";
    public $username = "root";
    public $password = "";
    public $DB = "blog";
        // use global $conn object in function
    function DBconnect()
    {
        $config = new Database($this->servername, $this->username, $this->password, $this->DB);
        $conn = (new databaseConn($config))->getConnection();
        return $conn;
    }
}