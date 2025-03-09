<?php

    $conn = require '../../config/connection.php';

    class UsersTable {
        public static function createUsersTable ($conn) {
            $query = 'CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                fullName VARCHAR(50) NOT NULL,
                email VARCHAR(100) NOT NULL,
                password VARCHAR(255) NOT NULL);';
                    
                if ($conn->query($query) === true) {
                    return 'Table users successfully added';
                } else {
                    return 'Error creating table: ' . $conn->error;
                }
            }
        }

    /* UsersTable::createUsersTable($conn); */

?>