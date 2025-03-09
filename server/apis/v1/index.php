<?php
    
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");

    /* $conn = require '../config/connection.php'; */
    $conn = require 'C:/xampp/htdocs/article_FAQs/server/config/connection.php';
    require '../../models/user.php';
    require '../../models/userSkeleton.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = userSkeleton::createUserSkeleton(null, $email, $password);
    $result = User::signIn($conn, $email, $password);

    /* if($result['status'] === 'success') {
        
    } */

    echo json_encode($result);

?>