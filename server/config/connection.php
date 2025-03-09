<?php

    $host = 'localhost:3307';
    $user = 'hsien';
    $password = '123456789';
    $name = 'faqs';

    $conn = new mysqli($host, $user, $password, $name);

    if($conn->connect_error) {
        die ('Connected');
    }

    return $conn;

?>