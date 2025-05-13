<?php
include "../class/Users.php";

$user = new Users();

if (isset($_POST['cancel'])) {
    $id = $_POST['id'];
    
    $result = $user->updateStatus($id);

    if ($result == 1) {
        $response = array(
            'success' => "Success",
        );
    } else if ($result == 2) {
        $response = array(
            'error' => "Error",
        );
    } else {
        $response = array(
            'error' => "Error",
        );
    }

    echo json_encode($response);
    exit;
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    
    $result = $user->deleteOrder($id);

    if ($result == 1) {
        $response = array(
            'success' => "Success",
        );
    } else if ($result == 2) {
        $response = array(
            'error' => "Error",
        );
    } else {
        $response = array(
            'error' => "Error",
        );
    }

    echo json_encode($response);
    exit;
}

