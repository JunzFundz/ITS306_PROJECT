<?php
include "../../class/Users.php";

$user = new Users();

if(isset($_GET['id'])){
    echo $id = $_GET['id'];

    $result = $user->selectItem($id);

    echo $result['food_name'];
}