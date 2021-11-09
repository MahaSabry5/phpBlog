<?php
class Database{
    public $servername ;
    public $username ;
    public $password ;
    public $DB ;

    // Constructor
    public function __construct($servername,$username,$password,$DB) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->DB = $DB;
    }
}

//$conn->close();
?>