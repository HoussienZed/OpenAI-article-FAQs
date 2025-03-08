<?php

    $conn = require '../../config/connection.php';

    class Insert {
        public static function insertUser ($conn, $fullName, $email, $password) {

            $query = $conn->prepare('INSERT INTO users (fullName, email, password) VALUES (?, ?, ?)');
            $query->bind_param('sss', $fullName, $email, $password);

            if($query->execute()) {
                echo 'user added correctly';
            } else {
                echo 'failed add user';
            }
        }

        public static function insertQuestion ($conn, $question, $answer){
            $query = $conn->prepare('INSERT INTO questions (question, answer) VALUES (?, ?)');
            $query->bind_param('ss', $question, $answer);

            if($query->execute()) {
                echo 'question added successfully';
            } else {
                echo 'failed add question';
            }
        }
    }

    /* Insert::insertUser($conn, 'houssien', '1@2.3', 'hashed password');
    Insert::insertQuestion($conn, '1st question', '1st answer'); */

?>