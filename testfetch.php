<?php

//// Starting Session - Constantine
//session_start();
////Including Database Connection function - Constantine
//include "./functions/dbcon.php";
//
////Including validation.php functions - Constantine
//include "./functions/validations.php";
//
//$username = "bikos13";
//$password = md5('12345678');
//
//$stmt = $mysqli->prepare("SELECT USER_ID, USERNAME, FIRSTNAME, LASTNAME FROM users WHERE USERNAME = ? AND USERPASS = ?");
//$stmt->bind_param('ss', $username, $password); // Setting Query parameters  - Constantine
//$stmt->execute();
//$stmt->bind_result($u, $ui, $f, $l);
//$stmt->fetch();
//
//    $u1 = $u;
//    $f1 = $f;
//    
//    echo $u1 . " " . $f1;
//$stmt->close(); //End of statement  - Constantine
//$mysqli->close(); //Closing mysqli object - Constantine
session_start();
echo '<pre>';
echo var_dump($_SESSION['loggedin']);
echo $_SESSION['userdata']['username'];
echo '</pre>';

?>