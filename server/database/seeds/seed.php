<?php

    $conn = require '../../config/connection.php';

    require '../migrations/createUserTable.php';
    require '../migrations/createQuestionsTable.php';

    class InsertUser {
        public static function insertUser ($conn, $fullName, $email, $password) {

            $query = $conn->prepare('INSERT INTO users (fullName, email, password) VALUES (?, ?, ?)');
            $query->bind_params('sss', $fullName, $email, $password);

            if($query->execute()) {
                return ['status' => 'user added correctly'];
            } else {
                return ['status' => 'failed add user'];
            }
        }
    }

?>