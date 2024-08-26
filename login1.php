<?php
include_once 'Connection/Connect.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Content-Type: application/json');
        echo json_encode(array("data" => false, "status" => "Invalid email format"));
        exit();
    }


    $fetch = $conn->prepare("SELECT * FROM `user_info` WHERE `email` = :email");
    $fetch->bindParam(':email', $email);
    $fetch->execute();
    $data = $fetch->fetch(PDO::FETCH_ASSOC);

    if ($data) {

        $res = password_verify($password, $data['password']);

        if ($res) {
            $sessionId = session_id();

            $updateSession = $conn->prepare("UPDATE `user_info` SET `session` = :session_id WHERE `email` = :email");
            $updateSession->bindParam(':session_id', $sessionId);
            $updateSession->bindParam(':email', $email);

            if ($updateSession->execute()) {
                $_SESSION['email'] = $email;
                $_SESSION['user']=$data['username'];

                header('Content-Type: application/json');
                echo json_encode(array("data" => true, "status" => "Login Successfull"));
                exit();


            
            } else {
                header('Content-Type: application/json');
                echo json_encode(array("data" => false, "status" => "Error updating session ID"));
                exit();
            }
        } else {
            header('Content-Type: application/json');
            echo json_encode(array("data" => false, "status" => "Invalid password"));
            exit();
        }
    } else {
        header('Content-Type: application/json');
        echo json_encode(array("data" => false, "status" => "Invalid User"));
        exit();



    }
}
?>