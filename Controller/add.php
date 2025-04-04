<?php
include "../class/Admin.php";

$user = new Admin();

if (isset($_POST['add_room'])) {
    $room = $_POST['rname'];
    $rnumber = $_POST['rnumber'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $imagePaths = [];
    $uploadDir = "../uploads/";

    if (!empty($_FILES['images']['name'][0])) {
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            if ($_FILES['images']['error'][$key] === 0) {
                $fileName = time() . "_" . $_FILES['images']['name'][$key];
                $filePath = $uploadDir . $fileName;

                if (move_uploaded_file($tmp_name, $filePath)) {
                    $imagePaths[] = $fileName;
                } else {
                    echo json_encode(["status" => "error", "message" => "File upload failed"]);
                    exit;
                }
            }
        }
    }

    $img = !empty($imagePaths) ? json_encode($imagePaths) : NULL;

    $result = $user->addRoom($room, $rnumber, $quantity, $price, $description, $img);
    
    if ($result) {
        $response = array(
            'success' => "Room added!",
        );
    } else {
        $response = array(
            'error' => "There was an error adding the item",
        );
    }
    echo json_encode($response);
    exit;
}
