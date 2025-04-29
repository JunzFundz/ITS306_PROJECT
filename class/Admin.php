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

    public function addRoom($room, $rnumber, $quantity, $price, $description, $img)
    {
        $db = $this->connect();
        $status = "pending";

        $stmt = $db->prepare("INSERT INTO tbl_rooms (r_name,r_number,r_price,r_quantity,r_description,r_image,r_date_added,r_status) VALUES (?,?,?,?,?,?,NOW(),?)");
        $stmt->bind_param("ssiisss", $room, $rnumber, $price, $quantity, $description, $img, $status);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }
    public function addBooking($name, $price, $quantity, $brand, $date) {
        $db = $this->connect();
        $status = "pending";

        $stmt = $db->prepare("INSERT INTO tbl_rooms (name ,price,quantity, brand ,date) VALUES (?,?,?,?,?)");
        $stmt->bind_param("siiss", $name, $price, $quantity, $brand, $date);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }
    public function cancelBooking($id) {
        $db = $this->connect();
        $status = "pending";

        $stmt = $db->prepare("UPDATE tbl_rooms SET r_status = 'canceled' WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }
}
