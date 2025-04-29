<?php

class Dbh
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = 'fundador142';
    private $dbname = 'cugondb';

    public function connect()
    {
        $stmt = new Mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->dbname
        );

        return $stmt;
    }
}
