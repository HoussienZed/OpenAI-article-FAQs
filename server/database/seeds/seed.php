<?php

    $conn = require '../../config/connection.php';

    class Insert {
        public static function insertUser ($conn, $fullName, $email, $password) {
            
            $hashedPassword = hash('sha256', $password);

            $query = $conn->prepare('INSERT INTO users (fullName, email, password) VALUES (?, ?, ?)');
            $query->bind_param('sss', $fullName, $email, $hashedPassword);

            if($query->execute()) {
                return ['status'=>'success','message'=>'user added correctly'];
            } else {
                return ['status'=>'error', 'message'=>'failed to add user'];
            }
        }

        public static function insertQuestion ($conn, $question, $answer){
            $query = $conn->prepare('INSERT INTO questions (question, answer) VALUES (?, ?)');
            $query->bind_param('ss', $question, $answer);

            if($query->execute()) {
                return ['status'=>'success','message'=>'question/answer added correctly'];
            } else {
                return ['status'=>'error', 'message'=>'failed to add question/answer'];
            }
        }
    }

    /* Insert::insertUser($conn, 'houssien', '1@2.3', 'hashed password');
    Insert::insertQuestion($conn, '1st question', '1st answer'); */

?>