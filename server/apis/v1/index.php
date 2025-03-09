<?php
    
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");

    $conn = require '../config/connection.php';
    require '../../models/user';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = User::signIn($conn, $email, $password);

    echo json_encode($result);

?>