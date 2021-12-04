<?php

$show_alert = false;
$show_error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "./partials/_dbconnection.php";
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    $exists = false;
    // Checking if users exists
    $sql_exist = "SELECT * FROM users WHERE username = '$username'";
    $ext_res = mysqli_query($conn, $sql_exist);
    $ext_rows = mysqli_num_rows($ext_res);

    if($ext_rows >= 1) {
        $exists = true;
    }
    
    if (($password == $cpassword) && $exists == false) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $ins_query = "INSERT INTO `users`(`username`, `password`, `date`) VALUES ('$username','$hash', current_timestamp())";

        $result = mysqli_query($conn, $ins_query);
        if ($result) {
            $show_alert = true;
        }
    }
    else {
        if($exists){
            $show_error = "Username already exists.";
        }
        else {
            $show_error = "Password does not match.";
        }
    }
}


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Authentication System | Signup</title>
</head>

<body>
    <?php require "./partials/_nav.php"  ?>

    <?php

    if ($show_alert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success! </strong> Signup successfull.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    if ($show_error) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error ! </strong>'. $show_error . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>

    <div class="container mt-3">
        <h1 class="text-center">Signup to our website.</h1>

        <form action="/rohit/authentication/signup.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="rohit" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" required>
            </div>

            <button class="btn btn-info">Signup</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>