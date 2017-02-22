<?php
session_start();
if ((isset($_SESSION['loggedin'])) && ($_SESSION['loggedin'] == TRUE)) {
    header('Location: profile.php?panel=newReservation');
}
 else {
     $_SESSION['alerts'] = "Please login here to make a reservation or <a href='register.php'>register here!</a>";
     header('Location: login.php');
}
?>