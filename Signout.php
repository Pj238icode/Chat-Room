<?php
 include_once 'Connection/Connect.php';
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['user'])) {
    $email = $_SESSION['email'];
   
    $stmt = $conn->prepare("UPDATE `user_info` SET `session` = NULL WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
}


session_unset();
session_destroy();

// Redirect to login page
header("Location: login.php");
exit();
?>
