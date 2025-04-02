<?php
include "../class/Users.php";

$user = new Users();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == '') {
        $response = array(
            'error' => "Field is empty",
        );
    }

    if ($password == '') {
        $response = array(
            'error' => "Field is empty",
        );
    }

    $result = $user->login($username, $password);

    if ($result === 1) {
        $response = array(
            'error' => "Incorrect password",
        );
    } else if ($result === 2) {
        $response = array(
            'error' => "Account not found",
        );
    } else {
        $response = array(
            'redirect' => $result
        );
    }

    echo json_encode($response);
    exit;
}
