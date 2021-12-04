<?php

echo "<h1>Connecting with database.</h1>";

/* Ways to connect with MySQL database 
    1. MySQLi Extension -> procedural and object oriented (only for mysql)
    2. PDO -> PHP Data Objects (different databases)
*/

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
else {
    echo "Connection successfull<br>";
}

// Creating database using PHP 
// $sql = "CREATE DATABASE php"; // query for creating databse
// $res = mysqli_query($conn, $sql);

// if($res){
//     echo "Database created successfully";
// }
// else {
//     echo "Could not create database. <br>" . mysqli_error($conn);
// }

// Creating a table 
// $sql = "CREATE TABLE FirstTable(name char(15), age int(2))";
// $res = mysqli_query($conn, $sql);

// if($res){
//     echo "Table created successfully";
// }
// else {
//     echo "Could not create Table. <br>" . mysqli_error($conn);
// }

// Creating a table 
$sql = "INSERT INTO firsttable values('Rohit', 21)";
$res = mysqli_query($conn, $sql);

if($res){
    echo "Data inserted successfully";
}
else {
    echo "Could not insert data. <br>" . mysqli_error($conn);
}




?>