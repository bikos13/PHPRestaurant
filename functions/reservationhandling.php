<?php

// Starting Session - Constantine
session_start();
//Including Database Connection function - Constantine
include "./dbcon.php";

//Including validation.php functions - Constantine
include "./validations.php";

if (isset($_POST['reservationform']) && $_POST['reservationform']) {
    //Validating inputs - Constantine
    $buserid = test_input($_POST['userid']);
    $bdate = test_input($_POST['bookingdate']);
    $btime = test_input($_POST['bookingtime']);
    $bpersons = test_input($_POST['persons']);
    $bsmoking = test_input($_POST['smokingbool']);
    //! End of Validate inputs - Constantine

    
    //================================================================================
    // Validate input date and hour to avoid past date/time reservations - Constantine
    //================================================================================

    $hournow = date('G:i:s'); // bind hour now
    $todate = date('Y-m-d'); // bind date today
    $errorMessage = "You can't make a reservation on a past date/hour (eg. <strong>NOT</strong> before $todate $hournow)"; // Message for false reservations


    if ($bdate < $todate) { // compare booking date to present date        
        $_SESSION['warnings'] = $errorMessage; // bind error message to session
        header('Location: ../profile.php?panel=newReservation');
    } else {
        if ($btime < $hournow) { // compare booking time to present time   
            $_SESSION['warnings'] = $errorMessage; // bind error message to session
            header('Location: ../profile.php?panel=newReservation');
        }
    }
    // End of Validate input date and hour to avoid past date/time reservations ======
    //================================================================================

    if ($stmt = $mysqli->prepare('INSERT INTO booking(BOOKING_DATE, BOOKING_TIME, BOOKING_SIZE, USERS_USER_ID, SMOKING_BOOL) VALUES (?, ?, ?, ?, ?)')) {
        //Value Binding - Constantine
        $stmt->bind_param('sssss', $bdate, $btime, $bpersons, $buserid, $bsmoking);
        $stmt->execute();
        $stmt->close();
        $_SESSION['successmessage'] = "Reservation Successful Mate! " . $fname . " ";
        header("Location: ../profile.php?panel=home");
    }
    $mysqli->close();
}
?>