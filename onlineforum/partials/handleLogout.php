<?php 
session_start();
session_unset();
session_destroy();
header("location: /rohit/onlineforum/index.php");
exit;
