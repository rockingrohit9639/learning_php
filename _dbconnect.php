<?php

// Connecting to database using mysqli
$servername = "localhost";
$username = "root";
$password = "";

// to use a database
$database = "php";

// Creating a connection
$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    die("Could not create connection". mysqli_connect_error());
    // die will stop the further execution 
}

?>