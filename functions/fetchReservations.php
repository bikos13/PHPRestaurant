<?php include 'functions/dbcon.php';

// Fetch Pending and Todau's reservations with two queries - Constantinos
$today = date("Y-m-d");
$pendingReservations = ""; //Initializing variable to bind pending reservations
$todaysReservations = ""; //Initializing variable to bind today's reservations

$sql = "SELECT COUNT(`BOOKING_ID`) FROM `booking` WHERE `booking_status_B_STATUS_ID` = '1'";
$result = $mysqli->query($sql);

    
        while ($row = $result->fetch_row()) {
        $pendingReservations =  $row['0'];
    }
    
$sql1 = "SELECT COUNT(`BOOKING_ID`) FROM `booking` WHERE `BOOKING_DATE` = '". $today ."' AND `booking_status_B_STATUS_ID` = '2'";

$result1 = $mysqli->query($sql1);

    
        while ($row = $result1->fetch_row()) {
        $todaysReservations =  $row['0'];
    }
    
$result->close();
$result1->close();
$mysqli->close();

// End of Fetch Pending and Todau's reservations with two queries

?>
