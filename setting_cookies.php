<?php
    /******************** Setting up Cookies ********************/
    // Cookies - it is like a tag which can be used to identify a user.
    // Cookies - stored on browser (no sensitive data)
    // Session - stored on server (sensitive data)

    echo "<h1>This is how you handle cookies in php</h1>";

    // Syntax to set a cokkies
    // setcookie("test", "test value", time() + 6000, "/");

    // Getting cookie
    // echo $_COOKIE['test'];

    // if(isset($_COOKIE['test'])){
    //     echo "test is set";
    // }

    /******************** Setting up sessions ********************/
    // Used to manage information accross different pages
    // starting a session
    
    // lets suppose user details are verified and we are starting the session for him/her
    session_start();
    // $_SESSION["username"] = "Rohit";
    // $_SESSION["favCat"] = "Books";
    // echo "Session is saved";

    /******************** Getting the session data ********************/
    echo "Welcome ". $_SESSION['username'];

    /******************** Logout ********************/
    session_unset();
    session_destroy();
    echo "You are logged out";
?> 