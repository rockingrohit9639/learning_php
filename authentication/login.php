<?php

$login = false;
$show_error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  require "./partials/_dbconnection.php";
  $username = $_POST["username"];
  $password = $_POST["password"];

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
        header("location: welcome.php");
      }
      else {
        $show_error = "Invalid Credentials";
      }
    }
  } else {
    $show_error = "Invalid Credentials";
  }
}


?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Authentication System | Login</title>
</head>

<body>
  <?php require "./partials/_nav.php"  ?>

  <?php

  if ($login) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success! </strong> You are logged in.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  }
  if ($show_error) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error ! </strong>' . $show_error . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  }
  ?>

  <div class="container mt-3">
    <h1 class="text-center">Login to our website.</h1>

    <form action="/rohit/authentication/login.php" method="POST">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="rohit" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button class="btn btn-info">Login</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>