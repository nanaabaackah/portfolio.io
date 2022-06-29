<?php
//Logs user out of account
session_start();

session_destroy();

foreach ($_COOKIE as $cookie){
    setcookie($cookie, "", 1);
}
//redirect to login page
header("Location: login.php");
exit();
?>