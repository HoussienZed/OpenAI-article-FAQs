<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");

    header('Content-Type: application/json');

    $conn = require '../../config/connection.php';
    require '../../database/migrations/createUserTable.php';
    require '../../database/seeds/seed.php';
    require '../../models/user.php';
    require '../../models/userSkeleton.php';

    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeatedPassword = $_POST['repeatedPassword'];

    $usersTable = UsersTable::createUsersTable($conn);
    //$userSkeleton = userSkeleton::createUserSkeleton($fullName, $email, $password);
    $user = User::createUser($conn, $fullName, $email, $password, $repeatedPassword);

    if ($user['status'] === 'success') {    
        $response = Insert::insertUser($conn, $fullName, $email, $password);
        $result = ['status'=>'success', 'message'=>'User signed up successfully'];
        echo json_encode($result);
    } else {
        $result = ['status'=>'error', 'message'=>$user['message']];
        echo json_encode($result);
    }
    
?>