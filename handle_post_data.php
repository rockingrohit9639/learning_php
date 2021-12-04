<?php 

    $databse = "php";
    $servername = "localhost";
    $username = "root";
    $pass = "";

    $conn = mysqli_connect($servername, $username, $pass, $databse);

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $name = $_POST['name'];
        $age = $_POST['age'];

        $sql = "INSERT INTO firsttable values('$name', $age)";
        $res = mysqli_query($conn, $sql);

        if($res){
            echo "Data inserted. <a href='/rohit/post_data.php'>Go Back</a>";
        }
        else {
            echo "Could not insert data. <br>" . mysqli_error($conn);
        }
    }

?>