<?php
include_once 'Connection/Connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $captcha_response = filter_var($_POST['g-recaptcha-response'], FILTER_SANITIZE_STRING);
    $secret_key = "";




    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Content-Type: application/json');
        echo json_encode(array("data" => false, "status" => "Invalid email format"));
        exit();
    }

    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$captcha_response");
    $response_keys = json_decode($response, true);

    if (!$response_keys['success']) {
        header('Content-Type: application/json');
        echo json_encode(['data' => false, 'status' => 'CAPTCHA verification failed. Please try again.']);
        exit();
    }

    $fetch = $conn->prepare("SELECT * FROM `user_info` WHERE `email` = :email");
    $fetch->bindParam(':email', $email);
    $fetch->execute();

    if ($fetch->rowCount() > 0) {
        header('Content-Type: application/json');
        echo json_encode(array("data" => false, "status" => "Email already exists"));
        exit();
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $img="user.png";
        $query = $conn->prepare("INSERT INTO `user_info` (`username`,`email`, `password`,`image`) VALUES (:username,:email, :password,:image)");
        $query->bindParam(':username', $username);
        $query->bindParam(':email', $email);
        $query->bindParam(':password', $hashedPassword);
        $query->bindParam(':image', $img);


        if ($query->execute()) {
            header('Content-Type: application/json');
            echo json_encode(array("data" => true, "status" => "Signup successful"));
            exit();
        } else {
            header('Content-Type: application/json');
            echo json_encode(array("data" => false, "status" => "Error occurred during signup"));
            exit();
        }
    }
}
?>