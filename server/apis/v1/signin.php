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

    if ($result['status'] === 'success') {    
        $response = Insert::insertUser($conn, $fullName, $email, $password);
        echo json_encode(['status'=>'success', 'message'=>'User signed up successfully']);
    } else {
        echo json_encode(['status'=>'error', 'message'=>$result['message']]);
    }

?>