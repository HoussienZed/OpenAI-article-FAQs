<?php

    $conn = require '../../config/connection.php';

    class QuestionsTable {
        public static function createQuestionsTable ($conn) {
            $query = 'CREATE TABLE IF NOT EXISTS questions (
                id INT AUTO_INCREMENT PRIMARY KEY,
                question TEXT NOT NULL,
                answer TEXT NOT NULL)';

            if ($conn->query($query) === true) {
                echo 'Table created successfully';
            } else {
                echo 'Table not created' . $conn->error;
            }
        }
    }

/*     QuestionsTable::createQuestionsTable($conn);
 */
?>