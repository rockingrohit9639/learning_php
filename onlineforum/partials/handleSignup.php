<?php 

    include "./_dbconnect.php";
    $showError = false;
    $showMessage = false;
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $username = $_POST["username"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];

        // Is users already exists ?
        $exits = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $exits);
        $rows = mysqli_num_rows($result);
        if($rows > 0){
            $showError = "User already exists";
            header("location: /rohit/onlineforum/index.php?signupsuccess=false&error=$showError");
        }
        else {
            if($password == $cpassword){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users(`username`, `password`, `timestamp`) values('$username', '$hash', current_timestamp())";
                $response = mysqli_query($conn, $sql);
                if(!$response){
                    $showError = "Could not create user. Please try again.";
                }
                else {
                    $showMessage = true;
                    header("location: /rohit/onlineforum/index.php?signupsuccess=true");
                }
            }
            else {
                $showError = "Passwords do not match";
            }
            header("location: /rohit/onlineforum/index.php?signupsuccess=false&error=$showError");
        }
    }
?>