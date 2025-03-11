<?php

class Connection {
    private $host = 'localhost';
    private $username = 'root';
    private $password = 'fundador142';
    private $dbname = 'capstone';

    public function connect(){
        $stmt = new Mysqli($this->host, $this->username, $this->password, $this->dbname);
        
        // if ($stmt->connect_error) {
        //     die("Connection failed: " . $stmt->connect_error);
        // }else{
        //     echo "Connection established";
        // }

        return $stmt;
    }
}

?>