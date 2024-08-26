<?php
header("Access-Control-Allow-Origin: http://localhost/CHAT%20ROOM/Dashboard.php");
header("Access-Control-Allow-Methods: POST,GET");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");
include_once 'Connection/Connect.php';



try {

    $query = $conn->prepare("SELECT `username`, `image` FROM `user_info` WHERE `session` IS NOT NULL");


    $query->execute();


    $users = $query->fetchAll(PDO::FETCH_ASSOC);


    if ($users) {
        header('Content-Type: application/json');
        echo json_encode($users);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['error' => true, 'message' => 'No users found']);
    }
} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(['error' => true, 'message' => $e->getMessage()]);
}
?>