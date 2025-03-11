<?php
include('Connection.php');

class Users extends Connection{

    public function register($username, $password)
    {
        $db = $this->connect();

        $stmt = $db->query("INSERT INTO users (username, password) VALUES ('$username', '$password')");

        return $stmt;
    }

    public function loginUser($username, $password)
    {
        $db = $this->connect();

        $stmt = $db->query("SELECT * from users where username = '$username' and password = '$password'");

        return $stmt;
    }

    public function deleteUser($id)
    {
        $db = $this->connect();

        $stmt = $db->query("DELETE FROM users where u_id = '$id'");

        return $stmt;
    }

    public function updateUser($username, $password)
    {
        $db = $this->connect();

        $stmt = $db->query("UPDATE users SET username = '$username' WHERE ");

        return $stmt;
    }

}


