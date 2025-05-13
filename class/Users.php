<?php
include('Connection.php');
require __DIR__.'/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email extends Dbh
{
    public function sendMail($email, $otp)
    {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->SMTPAuth   = true;
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->Username   = 'haish207@gmail.com';
        $mail->Password   = '';

        $mail->setFrom('haish207@gmail.com');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Registration OTP ';
        $mail->Body    = "Hello $email,<br><br>Your OTP is: $otp<br><br>Best regards,<br>The Team";
        $mail->AltBody = "Hello ,\n\nYour OTP is:  $otp\n\nBest regards,\nThe Team";

        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ];

        $mail->send();
    }
}
class Users extends Dbh
{

    public function register($sanitized_username, $sanitized_password)
    {
        $db = $this->connect();

        $hash_password = password_hash($sanitized_password, PASSWORD_DEFAULT);

        $stmt = $db->prepare("INSERT INTO users (username, password, created_at) VALUES (?,?,NOW())");
        $stmt->bind_param("ss", $sanitized_username, $hash_password);
        $result = $stmt->execute();

        // if($result){
        //     return true;
        // }else{
        //     return false;
        // }

        return $result;
    }

    public function login($username, $password)
    {
        session_start();

        $db = $this->connect();

        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $pass = $row['password'];

                if (password_verify($password, $pass)) {
                    $_SESSION['user_id'] = $row['user_id'];

                    $redirect = ($_SESSION['user_id'] === 341) ? '../public/admin/home.php' : '../public/user/home.php';

                    return $redirect;
                } else {
                    return 1; //Incorrect password
                }
            }
        } else {
            return 2; //User not found
        }
    }

    public function viewRooms()
    {
        $db = $this->connect();

        $stmt = $db->query("SELECT * FROM items");
        $result = $stmt->fetch_all(MYSQLI_ASSOC);

        return $result;
    }

    //View by specific user/client
    public function viewOrders($id)
    {
        $db = $this->connect();
        $stmt = $db->prepare("SELECT * FROM orders WHERE user_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result;
    }

    public function updateStatus($id)
    {
        $db = $this->connect();

        $stmt = $db->prepare("UPDATE orders SET status = 'Cancelled' WHERE order_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return 1; //true
        } else {
            return 2; //error
        }

        return 3; //error
    }

    public function deleteOrder($id)
    {
        $db = $this->connect();

        $stmt = $db->prepare("DELETE FROM orders WHERE order_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return 1; //true
        } else {
            return 2; //error
        }

        return 3; //error
    }

    public function selectItem($id)
    {
        $db = $this->connect();
        $stmt = $db->prepare("SELECT * FROM orders WHERE order_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0 ? $result->fetch_assoc() : null;;
    }
}
