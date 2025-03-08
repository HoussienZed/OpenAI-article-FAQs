<?php

    $conn = require '../../config/connection.php';

    class QuestionsTable {
        function createQuestionsTable ($conn) {
            $query = 'CREATE TABLE IF NOT EXISTS questions (
                id INT AUTO_INCREMENT PRIMARY KEY,
                question TEXT NOT NULL,
                answer TEXT NOT NULL)';

            if ($conn->query($query) === true) {
                return ['status'=>'Table created successfully'];
            } else {
                return ['status'=>'Table not created' . $conn->error];
            }
        }
    }

?>