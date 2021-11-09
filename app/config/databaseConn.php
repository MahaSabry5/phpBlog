<?php

class databaseConn {

    private static $conn;
    private static $config;

    public function __construct(Database $config)
    {
        self::$config = $config;
    }

    public static function getConnection() {
        if(!self::$conn) { // If no instance then make one
            self::$conn = new mysqli(self::$config->servername, self::$config->username,
                self::$config->password,self::$config->DB);
            if (self::$conn  ->connect_error) {
                die("Connection failed: " . self::$conn ->connect_error);
            }
        }
        return self::$conn;
    }

}


