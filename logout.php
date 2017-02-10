<?php
    session_start();
    session_destroy();
    session_start();
    $_SESSION['message'] = "You have logged out Succesfully!";
    header("Location: login.php");
?>