<?php 

if (!isset($_SESSION)) { session_start(); }

$loggin = false;
if (isset($_SESSION['loggedin']) || $_SESSION == true) {
  $loggin = true;
}

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/rohit/authentication/login.php">Auth System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="/rohit/authentication/login.php">Home</a>
        </li>';

        if($loggin){
          echo '<li class="nav-item">
          <a class="nav-link" href="/rohit/authentication/logout.php">Logout</a>
        </li>';
        }
        else {
          echo '<li class="nav-item">
          <a class="nav-link" href="/rohit/authentication/login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/rohit/authentication/signup.php">Signup</a>
        </li>';
        }

      echo '</ul>
    </div>
  </div>
</nav>';
