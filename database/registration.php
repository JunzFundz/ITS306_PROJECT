<?php

include('../class/Users.php');
$user = new Users();

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $result = $user->register($username, $password);

    if($result){
        echo "Success";
    }else{
        echo "Error";
    }
}

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $result = $user->loginUser($username, $password);

    if($result){
        echo "Success";
    }else{
        echo "Error";
    }
}

if(isset($_POST['delete'])){
    $id = $_POST['id'];
    
    $result = $user->deleteUser($id);

    if($result){
        echo "Success";
    }else{
        echo "Error";
    }
}

