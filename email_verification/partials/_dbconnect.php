<?php

    $username = "root";
    $hostname = "localhost";
    $password = "";
    $databsae = "email_verify";

    $conn = mysqli_connect($hostname, $username, $password, $databsae);

    if(!$conn){
        die("Could not connect to databse.");
    }

?>