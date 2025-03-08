<?php

    $host = 'localhost:3307';
    $user = 'root';
    $password = '';
    $name = 'FAQs';

    $conn = new mysqli($host, $user, $password, $name);

    if($conn->connect_error) {
        die ('Connected');
    }

    return $conn;

?>