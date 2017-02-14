<?php

// Starting Session - Constantine
session_start();
//Including Database Connection function - Constantine
include $_SERVER['DOCUMENT_ROOT'] . "./functions/dbcon.php";

//Including validation.php functions - Constantine
include $_SERVER['DOCUMENT_ROOT'] . "/functions/validations.php" ;
    
    if (isset($_POST['reservationform']) && $_POST['reservationform']) {
        //Validating inputs - Constantine
        $buserid = test_input($_POST['userid']);
        $bdate = test_input($_POST['bookingdate']);
        $btime = test_input($_POST['bookingtime']);
        $bpersons = test_input($_POST['persons']);
        $bsmoking = test_input($_POST['smokingbool']);
        //! End of Validate inputs - Constantine
        echo "$buserid $bdate $btime $bpersons $bsmoking";
        
        if ($stmt = $mysqli->prepare('INSERT INTO booking(BOOKING_DATE, BOOKING_TIME, BOOKING_SIZE, USERS_USER_ID, SMOKING_BOOL) VALUES (?, ?, ?, ?, ?)')) {
                //Value Binding - Constantine
                $stmt->bind_param('sssss', $bdate, $btime, $bpersons, $buserid, $bsmoking);
                $stmt->execute();
                $stmt->close();
                $_SESSION['reservationmessage'] = "Reservation Successful Mate! " . $fname . " ";
                header("Location: ../profile.php?panel=home");
            }
            $mysqli->close();
    }
?>