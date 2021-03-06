<?php

if (!isset($_SESSION)) { session_start(); }

$loggin = false;
if (isset($_SESSION['loggedin']) || $_SESSION == true) {
  $loggin = true;
}

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
    <a class="navbar-brand" href="/rohit/onlineforum/"><h3>iDiscuss</h3></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/rohit/onlineforum/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/rohit/onlineforum/about.php">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/rohit/onlineforum/contact.php">Contact Us</a>
            </li>
        </ul>
        <form class="d-flex" action="/rohit/onlineforum/search.php">
            <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-success" type="submit">Search</button>
        </form>
        <div class="mx-2">
            ';
            if($loggin){
                echo '
                <div class="d-flex align-items-center text-white" style="gap: 0.5rem;">
                <p class="m-0">Welcome <strong>'. $_SESSION["username"] .'</strong></p>
                <a href="/rohit/onlineforum/partials/handleLogout.php" class="btn btn-outline-primary">Logout</a>
                </div>';
            }
            else{
            echo '<button class="btn btn-outline-primary ml-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#signupModal">SignUp</button>';
            }

        echo '</div>
    </div>
</div>
</nav>';

include "./partials/_loginmodal.php"; 
include "./partials/_signupmodal.php"; 

if(isset($_GET["signupsuccess"]) && $_GET["signupsuccess"]=="true"){
    echo   '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                <strong>Success !!</strong> Account created successfully. You can now login.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
}
elseif(isset($_GET["signupsuccess"]) && $_GET["signupsuccess"]=="false"){
    echo   '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                <strong>Ooops !!</strong> '. $_GET["error"] .'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
}

if(isset($_GET["login"]) && $_GET["login"]=="true"){
    echo   '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                <strong>Success !!</strong> You are now logged in.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
}
elseif(isset($_GET["login"]) && $_GET["login"]=="false"){
    echo   '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                <strong>Ooops !!</strong> '. $_GET["error"] .'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
}

?>
