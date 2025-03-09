<?php

    /* $conn = require '../config/connection.php'; */ //this path didnt work dont know why
    $conn = require 'C:/xampp/htdocs/article_FAQs/server/config/connection.php';


    class User {
        
        public static function createUser($conn, $fullName, $email, $password, $repeatedPassword) {
            
            if(!isset($fullName) || !isset($email) || !isset($password) || !isset($repeatedPassword)) {
                return ['status'=>'error', 'message'=>'All fields are required'];
            }

            if ($password !== $repeatedPassword) {
                return ['status'=>'error', 'message'=>'Passwords do not match'];
            }

            $emailCheckQuery = $conn->prepare('SELECT * FROM users WHERE email = ?');
            $emailCheckQuery->bind_param('s', $email);
            $emailCheckQuery->execute();

            $user = $emailCheckQuery->get_result();
            
            if($user->num_rows > 0) {
                return ['status'=>'error', 'message'=>'Email already exists'];
            } else {
                return ['status'=>'success', 'message'=>'Email is unique'];
            }
        }

        public static function signIn($conn, $email, $password) {

            if (!isset($_POST['email']) || !isset($_POST['password'])) {
                return ['status' => 'error', 'message' => 'Email or password not provided'];
            }

            $query = $conn->prepare('SELECT * FROM users WHERE email = ?');
            $query->bind_param('s', $email);
            $query->execute();

            $result = $query->get_result();
            $user = $result->fetch_assoc();
            $userHashedPassword = $user['password'];

            if(password_verify($password, $userHashedPassword)) {
                return ['status'=>'success', 'message'=>'User logged in successfully'];
            } else {
                return ['status'=>'error', 'message'=>'Email and password dont match'];
            }
        }

        public static function deleteUser($conn, $email) {

            $deleteEmailQuery = $conn->prepare('DELETE FROM users WHERE email = ?');
            $deleteEmailQuery->bind_param('s', $email);
            
            if($deleteEmailQuery->execute()) {
                return ['status'=>'success', 'message'=>'user deleted successfully'];
            } else {
                return ['status'=>'error', 'message'=>'cannot delete user'];
            }
        }

        public static function editUSer ($conn, $fullName, $email, $password, $repeatedPassword) {

            if(!isset($fullName) || !isset($email) || !isset($password) || !isset($repeatedPassword)) {
                return ['status'=>'error', 'message'=>'All fields are required'];
            }

            if ($password !== $repeatedPassword) {
                return ['status'=>'error', 'message'=>'Passwords do not match'];
            }

            $getUserIdQuery = $conn->prepare('SELECT * FROM users WHERE email = ?');
            $getUserIdQuery->bind_param('s', $email);
            $getUserIdQuery->execute();

            $getUserIdQueryResult = $getUserIdQuery->get_result();
            $userCredentials = $getUserIdQueryResult->fetch_assoc();
            
            if(!$userCredentials) {
                return ['status'=>'error', 'message'=>'User not found'];
            }

            $userId = $userCredentials['id'];

            $hashedPassword = hash('sha256', $password);
            
            $editUserQuery = $conn->prepare('UPDATE users SET fullName = ?, email = ?, password = ? WHERE id = ?');
            $editUserQuery->bind_param('sssi', $fullName, $email, $hashedPassword, $userId);
            
            if($editUserQuery->execute()){
                return ['status'=>'success', 'message'=>'User edited successfully'];
            } else {
                return ['status'=>'error', 'message'=>'User not edited'];
            }

        }
    } 

?>