<?php

$login = false;
$show_error = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include "./_dbconnect.php";
  $username = $_POST["loginusername"];
  $password = $_POST["loginpassword"];
  $sql = "SELECT * FROM users WHERE username = '$username'"; //AND password = '$password'
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);

  if ($num == 1) {
    while ($row = mysqli_fetch_assoc($result)) {
      if (password_verify($password, $row["password"])) {
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['userid'] = $row["user_id"];
        header("location: /rohit/onlineforum/index.php?login=true");
      }
      else {
        $show_error = "Invalid Credentials";
        header("location: /rohit/onlineforum/index.php?login=false&error=$show_error");
      }
    }
  } else {
    $show_error = "Invalid Credentials";
    header("location: /rohit/onlineforum/index.php?login=false&error=$show_error");
  }
}
