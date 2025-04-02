<?php
include('Connection.php');

class Admin extends Dbh
{
    public function view()
    {
        $stmt = $this->connect()->query("SELECT * FROM users");
        $result = $stmt->fetch_all(MYSQLI_ASSOC);

        return $result;
    }
}