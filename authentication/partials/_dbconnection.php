<?php

    $database = "users";
    $username = "root";
    $hostname = "localhost";
    $password = "";

    $conn = mysqli_connect($hostname, $username, $password, $database);
    
    if(!$conn) {
        die("Could not connect to the databse");
    }

?>