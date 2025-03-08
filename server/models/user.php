<?php

    require '../config/connection.php';

    class USer {
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
            
            if($emailCheckQuery->num_rows > 0) {
                return ['status'=>'error', 'message'=>'Email already exists'];
            }

            $hashedPassword = hash('sha256', $password);

            $creatUserQuery = $conn->prepare('INSERT INTO users (fullName, email, password) VALUES (?, ?, ?)');
            $creatUserQuery->bind_param('sss', $fullName, $email, $hashedPassword);
            
            if($creatUserQuery->execute()) {
                return ['status'=>'success', 'message'=>'user added successfully'];
            }
        }

        public static function deleteUSer($conn, $email) {

            $deleteEmailQuery = $conn->prepare('DELETE FROM users WHERE email = ?');
            $deleteEmailQuery->bind_param('s', $email);
            
            if($deleteEmailQuery->execute) {
                return ['status'=>'success', 'message'=>'user deleted successfully'];
            } else {
                return ['status'=>'error', 'message'=>'cannot delete user'];
            }
        }
    } 

?>