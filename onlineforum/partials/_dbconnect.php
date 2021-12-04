<?php 
    $database = "idiscuss";
    $hostname = "localhost";
    $username = "root";
    $password = "";

    $conn = mysqli_connect($hostname, $username, $password, $database);

    if(!$conn){
        die("Could not connect to databse");
    }

?>