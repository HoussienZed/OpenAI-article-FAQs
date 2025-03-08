<?php

    $host = "localhost:3307";
    $user = "root";
    $password = "";
    $name = "FAQs";

    $mysqli = new mysqli($host, $user, $password, $name);

    if($mysqli->connect_error) {
        die ("Connected");
    }

?>