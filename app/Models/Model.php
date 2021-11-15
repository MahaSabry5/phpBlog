<?php

namespace App\Models;

require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../config/databaseConn.php";

class Model{
    public $conn;
    public $servername = "localhost";
    public $username = "root";
    public $password = "";
    public $DB = "blog";
    public $connection;
    public function __construct()
    {
        $this->connection = $this->DBconnect();
    }

    public function DBconnect()
    {
        $config = new \Database($this->servername, $this->username, $this->password, $this->DB);
        $conn = (new \databaseConn($config))->getConnection();
        return $conn;
    }
}