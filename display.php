<?php


header("Access-Control-Allow-Origin: http://localhost/CHAT%20ROOM/Dashboard.php");
header("Access-Control-Allow-Methods: POST,GET");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");


include_once 'Connection/Connect.php';

session_start();



try {
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];

        $stmt = $conn->prepare("SELECT `username`, `image` FROM `user_info` WHERE email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            header('Content-Type: application/json');
            echo json_encode($user);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['error' => true, 'message' => 'User not found']);
        }
    } else {
        header('Content-Type: application/json');
        echo json_encode(['error' => true, 'message' => 'No session found']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => true, 'message' => $e->getMessage()]);
}
?>