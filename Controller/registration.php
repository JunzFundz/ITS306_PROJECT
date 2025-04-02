<?php

include('../class/Users.php');
$user = new Users();

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    //Validation
    if($username == ''){
        echo "Username id empty";
        exit;
    }
    if($password == ''){
        echo "password id empty";
        exit;
    }

    //Sanitize
    $sanitized_username = filter_var($username, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sanitized_password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    $hash_password = password_hash($sanitized_password, PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO users (username, password, date_created) VALUES (?,?,NOW())");
    $stmt->bind_param("ss", $sanitized_username, $hash_password);
    $result = $stmt->execute();

    if($result){
        header('location: ../pages/login.php');
    }else{
        echo "Error";
    }
}

    $result = $user->register($sanitized_username, $sanitized_password);