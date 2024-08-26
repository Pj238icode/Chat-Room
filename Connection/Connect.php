<?php
try {
    $db_name = "chat room";
    $db_user = "root";
    $db_password = "";
    $db_host = "localhost";
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (Exception $e) {
    $e->getMessage();
}






?>