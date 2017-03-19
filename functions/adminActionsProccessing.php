<h1>Proccessing Information</h1>
<?php
// Starting Session - Constantine
session_start();
//Including Database Connection function - Constantine
include "dbcon.php";

//Including validation.php functions - Constantine
include "validations.php";

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "POST") { //FILTERING INCOMING METHOD POST
    $source = filter_input(INPUT_POST, 'source');
    $action = filter_input(INPUT_POST, 'action');
    $id = filter_input(INPUT_POST, 'id');
}

If (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "GET") { //FILTERING INCOMING METHOD GET
    $source = filter_input(INPUT_GET, 'source');
    $action = filter_input(INPUT_GET, 'action');
    $id = filter_input(INPUT_GET, 'id');
}

//======================================================================================
// Filtering the source to use the appropriate functions and operations - Constantine ==
//======================================================================================

/* TABLE OF CONTENTS
 * 
 * 1. Table actions
 * 
 *      1a. Add Table
 *      1b. Delete Table
 *      1c. Unknown action error
 * 
 * 2. Setting hours function
 * 
 * 3. Reservations handling
 * 
 *      3a. Cancel Reservation
 *      3b. Cancel old pending reservations
 *      3c. Insert reservation
 *      3d. Unknown action error
 * 
 * 4. Users handling
 *      4a. Add new users 
 */

If ($source != null) { // Checking if the source is valid (Source checks from where the request have arrived
    switch ($source):




//======================================================================================
// 1. Tables Case and Actions - Constantine ============================================
//======================================================================================
        case('tables'):
            $id = strtoupper($id); // Capitalizing input - Constantine

            switch ($action):

//=======================================================================================
// 1a. Add Table - Constantine ==========================================================
//=======================================================================================               


                case('add'):
                    $tablesize = filter_input(INPUT_GET, 'size');
                    $smoking = filter_input(INPUT_GET, 'smoking');
                    if (($tablesize != null) && ($smoking != null)) {
                        echo "$id $tablesize $smoking";
                        $sql = "INSERT INTO `tables`(`TABLE_CODE`, `TABLE_SIZE`, `SMOKING`) VALUES ('$id','$tablesize','$smoking')";
                        $mysqli->query($sql);
                        if ($mysqli->connect_errno) {
                            die("Insert into tables failed: %s\n" . $mysqli->connect_error);
                            exit();
                        }

                        $mysqli->close();
                        $_SESSION['successmessage'] = "The table $id has been successfully added";
                        header('Location: ../adminIndex.php?panel=manageTables&page=1');
                    } else {
                        $mysqli->close();
                        $_SESSION['warnings'] = "No table with this id has been found";
                        header('Location: ../adminIndex.php?panel=manageTables&page=1');
                        die('Invalid table inputs');
                    }
                    break;


// End of 1a. Add Table - Constantine ===================================================
//======================================================================================= 
//=======================================================================================
// 1b. Delete Table - Constantine =======================================================
//=======================================================================================     

                case('delete'):
                    $sql = "SELECT * FROM tables WHERE TABLE_CODE = '$id'";
                    $result = $mysqli->query($sql);

                    if ($result->num_rows == 1) {

                        $sql1 = "DELETE FROM tables WHERE TABLE_CODE = '$id'";
                        $mysqli->query($sql1);
                        $mysqli->close();
                        $_SESSION['successmessage'] = "The table $id has been successfully deleted";
                        header('Location: ../adminIndex.php?panel=manageTables&page=1');
                    } else {
                        $mysqli->close();
                        $_SESSION['warnings'] = "No table with this id has been found";
                        header('Location: ../adminIndex.php?panel=manageTables&page=1');
                        die('No table with this id has been found');
                    }
                    break;

// End of 1b. Delete Table ==============================================================
//=======================================================================================  
//=======================================================================================
// 1c. Unknown action error - Constantine ===============================================
//=======================================================================================

                default :
                    $_SESSION['warnings'] = "Uknown action error";
                    header('Location: ../adminIndex.php?panel=manageTables&page=1');
                    break;

// End of 1c. Unknown action error ======================================================
//=======================================================================================
            endswitch;

            break;

// End of 1. Tables Case and actions ===================================================
//======================================================================================
//
//
//
//======================================================================================
// 2. Setting hours function - Constantine =============================================
//======================================================================================

        case('setHours'):

            $ClosedTrigger = array(//This array hold the value of the checkbox Closed - Constantine
                'Mon' => filter_input(INPUT_GET, 'MondayClosed'),
                'Tue' => filter_input(INPUT_GET, 'TuesdayClosed'),
                'Wed' => filter_input(INPUT_GET, 'WednesdayClosed'),
                'Thu' => filter_input(INPUT_GET, 'ThursdayClosed'),
                'Fri' => filter_input(INPUT_GET, 'FridayClosed'),
                'Sat' => filter_input(INPUT_GET, 'SaturdayClosed'),
                'Sun' => filter_input(INPUT_GET, 'SundayClosed')
            );

            $Openinghours = array(//This array hold the value of the opening hours - Constantine
                'Mon' => filter_input(INPUT_GET, 'MondayOpen'),
                'Tue' => filter_input(INPUT_GET, 'TuesdayOpen'),
                'Wed' => filter_input(INPUT_GET, 'WednesdayOpen'),
                'Thu' => filter_input(INPUT_GET, 'ThursdayOpen'),
                'Fri' => filter_input(INPUT_GET, 'FridayOpen'),
                'Sat' => filter_input(INPUT_GET, 'SaturdayOpen'),
                'Sun' => filter_input(INPUT_GET, 'SundayOpen')
            );

            $Closinghours = array(//This array hold the value of the closing hours - Constantine
                'Mon' => filter_input(INPUT_GET, 'MondayClose'),
                'Tue' => filter_input(INPUT_GET, 'TuesdayClose'),
                'Wed' => filter_input(INPUT_GET, 'WednesdayClose'),
                'Thu' => filter_input(INPUT_GET, 'ThursdayClose'),
                'Fri' => filter_input(INPUT_GET, 'FridayClose'),
                'Sat' => filter_input(INPUT_GET, 'SaturdayClose'),
                'Sun' => filter_input(INPUT_GET, 'SundayClose')
            );

            foreach ($ClosedTrigger as $day => $value) {
                If (($value != null) && ($value === 'on')) {
                    $sqlcltrigger = "UPDATE `storehours` SET `IS_CLOSED`='1' WHERE DAY_NAME = '$day'";
                    $mysqli->query($sqlcltrigger);
                    if ($mysqli->connect_errno) {
                        $mysqli->close();
                        die("Hours update failed: %s\n" . $mysqli->connect_error);
                    }
                } else {
                    $sqlcltrigger = "UPDATE `storehours` SET `IS_CLOSED`='0' WHERE DAY_NAME = '$day'";
                    $mysqli->query($sqlcltrigger);
                    if ($mysqli->connect_errno) {
                        $mysqli->close();
                        die("Hours update failed: %s\n" . $mysqli->connect_error);
                    }
                }
            }

            foreach ($Openinghours as $day => $value) {

                $sqlcltrigger = "UPDATE `storehours` SET `OPENING_HOUR`='$value' WHERE DAY_NAME = '$day'";
                $mysqli->query($sqlcltrigger);
                if ($mysqli->connect_errno) {
                    $mysqli->close();
                    die("Hours update failed: %s\n" . $mysqli->connect_error);
                }
            }

            foreach ($Closinghours as $day => $value) {
                $sqlcltrigger = "UPDATE `storehours` SET `CLOSING_HOUR`='$value' WHERE DAY_NAME = '$day'";
                $mysqli->query($sqlcltrigger);
                if ($mysqli->connect_errno) {
                    $mysqli->close();
                    die("Hours update failed: %s\n" . $mysqli->connect_error);
                }
            }

            $mysqli->close();
            $_SESSION['successmessage'] = "Hours updated Successfully";

            header('Location: ../adminIndex.php?panel=setStoreHours');
            break;

// End of 2. Setting hours function - Constantine ======================================
//======================================================================================
//
//
//
//======================================================================================
// 3. Reservations handling - Constantine ==============================================
//======================================================================================          
        case('reservations'):
            switch ($action):

//======================================================================================
// 3a. Cancel Reservation - Constantine ================================================
//======================================================================================     
                case('cancelReservation'):
                    $sql = "UPDATE `booking` SET `booking_status_B_STATUS_ID`='3' WHERE BOOKING_ID = '$id'";
                    $mysqli->query($sql);
                    if ($mysqli->connect_errno) {
                        $mysqli->close();
                        die("Could not find this reservation ID to cancel it. : %s\n" . $mysqli->connect_error);
                    } else {
                        $mysqli->close();
                        $_SESSION['successmessage'] = "The reservations with <strong>ID: $id has been succesfully cancelled</strong>";
                        $mysqli->close();
                        header('Location: ../adminIndex.php?panel=viewReservations&page=1');
                    }

                    break;
// End of 3a. Cancel a reservation =====================================================
//======================================================================================
//
//
//
//======================================================================================
// 3b. Cancel old pending reservations - Constantine ===================================
//======================================================================================                  
                case('cancelOldPendingReservations'):
                    $sqlclearOld = "UPDATE `booking` SET `booking_status_B_STATUS_ID`='4' WHERE `booking_status_B_STATUS_ID`='1' AND BOOKING_DATE < CURDATE()";
                    $result2 = $mysqli->query($sqlclearOld);
                    $affectedRecords = $mysqli->affected_rows;
                    if ($affectedRecords > 0) {
                        $_SESSION['successmessage'] = "You have succesfully changed the status of <strong>$affectedRecords pending</strong> reservations to <strong>Unattended</strong>";
                    } else {
                        $_SESSION['successmessage'] = "There weren't any unattended reservations to proccess!";
                    }
                    $mysqli->close();
                    header('Location: ../adminIndex.php?panel=viewReservations&page=1');
                    break;


// End of 3b. Cancel old pending reservations  =========================================
//======================================================================================
//
//
//
//
//
//======================================================================================
// 3c. Insert reservation - Constantine ================================================
//======================================================================================                  
                case('insertReservation'):


                    $reservationdata = filter_input_array(INPUT_POST);
                    echo "<pre>";
                    echo var_dump($reservationdata);
                    echo "</pre>";

                    echo $reservationdata['reservationType'];

                    //======================================================================================  
                    // Step 1: Approve (Update) or insert Reservations - Constantine =======================
                    //======================================================================================  

                    if ($reservationdata['reservationType'] === 'new') {

                        $sqlInsertReservation = "INSERT INTO `booking`(`BOOKING_DATE`, `BOOKING_TIME`, `BOOKING_SIZE`, `USERS_USER_ID`, `SMOKING_BOOL`, `booking_status_B_STATUS_ID`) VALUES ('" . $reservationdata['bookingdate'] . "','" . $reservationdata['bookingtime'] . "','" . $reservationdata['reservationSize'] . "','" . $reservationdata['userid'] . "','" . $reservationdata['smokingBoolean'] . "','2')";
                        $resultFromInserted = $mysqli->query($sqlInsertReservation);

                        if ($mysqli->connect_errno) {
                            die("Database Connection failed: %s\n" . $mysqli->connect_error);
                            exit();
                        } else {
                           $newReservationIDInserted = $mysqli->insert_id; // Gets the inserted reservations ID (from the query) - Constantine
                        echo "New Reservation ID is: $newReservationIDInserted <br>"; // testing usage of the line above
                        $_SESSION['successmessage'] = "Reservation successful and <strong>Approved</strong><br>Tables Assigned: ";
                        }
                        
                    } elseif ($reservationdata['reservationType'] === 'existing') {

                        $sqlUpdateStatus = "UPDATE `booking` SET booking_status_B_STATUS_ID='2' WHERE `BOOKING_ID` = '" . $reservationdata['reservationID']."' "; // UPDATE RESERVATION STATUS - Constantine
                        $mysqli->query($sqlUpdateStatus);
                        $affectedRecords = $mysqli->affected_rows;
                        if ($affectedRecords > 0) {
                            $_SESSION['successmessage'] = "Reservation status: <strong>Approved</strong><br>Tables Assigned: ";
                        } else {
                            $_SESSION['warnings'] = "Reservation Insert Error";
                            $mysqli->close();
                            header('Location: ../adminIndex.php?panel=viewReservations&page=1');
                        } // End of UPDATE RESERVATION STATUS
                    } else {
                        die('ViolationDetected');
                    }


                    // End of Step 1: Approve (Update) or insert Reservations -  ===========================
                    //======================================================================================
                    //
                    //
                    //
                    //======================================================================================  
                    // Step 2: Bind Tables into reservations - Constantine =================================
                    //======================================================================================  


                    if ($reservationdata['reservationType'] === 'new') {

                        foreach ($reservationdata as $key => $value) {
                            if (preg_match('/^tableSelected[A-Z][0-9]$/', $key)) {
                                $sqlInsertTable = "INSERT INTO `tables_booked`(`Booking_BOOKING_ID`, `TABLES_TABLE_CODE`) VALUES ('" . $newReservationIDInserted . "', '" . $value . "')";
                                $mysqli->query($sqlInsertTable);

                                if ($mysqli->connect_errno) {
                                    die("Database Connection failed: %s\n" . $mysqli->connect_error);
                                    exit();
                                }
                                $_SESSION['successmessage'] .= " <strong>$value</strong>";
                            }
                        }
                    } elseif ($reservationdata['reservationType'] === 'existing') {
                        foreach ($reservationdata as $key => $value) {
                            if (preg_match('/^tableSelected[A-Z][0-9]$/', $key)) {
                                $sqlInsertTable = "INSERT INTO `tables_booked`(`Booking_BOOKING_ID`, `TABLES_TABLE_CODE`) VALUES ('" . $reservationdata['reservationID'] . "', '" . $value . "')";
                                $mysqli->query($sqlInsertTable);

                                if ($mysqli->connect_errno) {
                                    die("Database Connection failed: %s\n" . $mysqli->connect_error);
                                    exit();
                                }
                                $_SESSION['successmessage'] .= " <strong>$value</strong>";
                            }
                        }
                    }
                    
                    
                    // End of Step 2: Bind Tables into reservations - ======================================
                    //====================================================================================== 
                    
                    $mysqli->close(); // After Successfull procedure
                    header('Location: ../adminIndex.php?panel=viewReservations&page=1');



                    break;


// End of 3c. Insert reservation  ======================================================
//======================================================================================
//
//
//
//
//
//======================================================================================
// 3d. Unknown action error - Constantine ==============================================
//======================================================================================
                default:
                    $_SESSION['warnings'] = "Uknown action error";
                    header('Location: ../adminIndex.php?panel=viewReservations&page=1');
                    break;
// End of 3d. Unknown action error =====================================================
//======================================================================================                   

            endswitch;
            break;

// End of 3. Reservation handling ======================================================
//====================================================================================== 
//
//
//
//======================================================================================
// 4. Users handling - Constantine =====================================================
//======================================================================================  
        case('usersHandling'):
            switch ($action):


//======================================================================================
// 4a. Add new users - Constantine =====================================================
//======================================================================================  
                case('addUser'):
                    $errorString = ""; //Initialize error message
                    $errorCounter = 0; //Error Counter

                    $username = test_input($_POST['username']);
                    $password = test_input($_POST['password']);
                    $fname = test_input($_POST['fname']);
                    $lname = test_input($_POST['lname']);
                    $email = test_input($_POST['email']);
                    $phoneNumber1 = test_input($_POST['phoneNumber1']);
                    $phoneNumber2 = test_input($_POST['phoneNumber2']);
                    $passwordRepeat = test_input($_POST['passwordRepeat']);
                    $userLevel = test_input($_POST['userLevel']);

                    //Checking if the username and email already exist - Constantine
                    $sql1 = "SELECT * FROM USERS WHERE EMAIL = '$email'";
                    $result1 = $mysqli->query($sql1);

                    if ($mysqli->connect_errno) {
                        die("Database Connection failed: %s\n" . $mysqli->connect_error);
                        exit();
                    }

                    if ($result1->num_rows > 0) {
                        while ($row = $result1->fetch_assoc()) {
                            $errorCounter++;
                            $errorString .= "$errorCounter. This email (" . $row['EMAIL'] . ") already exists and belongs to " . $row['FIRSTNAME'] . " " . $row['LASTNAME'] . " registered on " . $row['TIMESTAMP_REGISTERED'] . ".<br><br>";
                        }
                    }

                    $sql2 = "SELECT * FROM USERS WHERE USERNAME = '$username'";
                    $result2 = $mysqli->query($sql2);

                    if ($mysqli->connect_errno) {
                        die("Database Connection failed: %s\n" . $mysqli->connect_error);
                        exit();
                    }

                    if ($result2->num_rows > 0) {
                        while ($row = $result2->fetch_assoc()) {
                            $errorCounter++;
                            $errorString .= "$errorCounter. This username (" . $row['USERNAME'] . ") already exists and belongs to " . $row['FIRSTNAME'] . " " . $row['LASTNAME'] . " registered on " . $row['TIMESTAMP_REGISTERED'] . ".<br><br>";
                        }
                    }
                    //End of Checking if the username and email already exist - Constantine
                    //Checking if password matches the repeated password - Constantine
                    if ($password !== $passwordRepeat) {
                        $errorCounter++;
                        $errorString .= "$errorCounter. The passwords entered in password and password repeat field do not match. <br><br>";
                    }
                    //End of Checking if password matches the repeated password
                    // Testint Inputs - Constantine

                    if (!preg_match("/^[a-zA-Z ]*$/", $fname)) {
                        $errorCounter++;
                        $errorString .= "$errorCounter. Only letters and white space allowed in the <strong>first name</strong> field<br><br>";
                    }

                    if (!preg_match("/^[a-zA-Z ]*$/", $lname)) {
                        $errorCounter++;
                        $errorString .= "$errorCounter. Only letters and white space allowed in the <strong>last name</strong> field<br><br>";
                    }

                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $errorCounter++;
                        $errorString .= "$errorCounter. Invalid <strong>email</strong> format <br><br>";
                    }
                    if ((!preg_match("/^[\+0-9\-\(\)\s]*$/", $phoneNumber1)) || (!preg_match("/^[\+0-9\-\(\)\s]*$/", $phoneNumber2))) {
                        $errorCounter++;
                        $errorString .= "$errorCounter. Only numbers are allowed in <strong>Contact Numbers</strong><br><br>";
                    }

                    if (strlen($password) <= '7') {
                        $errorCounter++;
                        $errorString .= "$errorCounter. <strong>Make sure that password is at least 8 characters long!</strong><br><br>";
                    }
                    if (!preg_match("/^[0-9]+/", $userLevel)) {
                        die('Violation Detected');
                    }
                    // End of inputs testing

                    if ($errorCounter > 0) { //If any errors where found
                        $_SESSION['warnings'] = $errorString;
                        $mysqli->close();
                        header("Location: ../adminIndex.php?panel=newUser");
                    } else {
                        $password = md5($password);
                        $sql = "INSERT INTO `users`(`FIRSTNAME`, `LASTNAME`, `USERNAME`, `USERPASS`, `EMAIL`, `CONTACT_NUMBER_1`, `CONTACT_NUMBER_2`, `UserLevels_USERLEVEL_ID`) VALUES ('$fname','$lname','$username','$password','$email','$phoneNumber1','$phoneNumber2','$userLevel')";
                        $result = $mysqli->query($sql);

                        if ($mysqli->connect_errno) {
                            die("Database Connection failed: %s\n" . $mysqli->connect_error);
                            exit();
                        }

                        $sqlCheck = "SELECT * FROM users WHERE USERNAME = '$username'";
                        $resultCheck = $mysqli->query($sqlCheck);

                        if ($resultCheck->num_rows > 0) {

                            while ($row = $resultCheck->fetch_assoc()) {
                                $mysqli->close();
                                $_SESSION['successmessage'] = "<strong>" . $row['USERNAME'] . "</strong> has been added to the Database with the corresponding ID <strong>#" . $row['USER_ID'] . "</strong>. If you want to make a reservation for this user <a href='/adminIndex.php?panel=newReservation&userid=" . $row['USER_ID'] . "&email=" . $row['EMAIL'] . "&fname=" . $row['FIRSTNAME'] . "&lname=" . $row['LASTNAME'] . "&reservationType=new'>click here</a>";
                                header("Location: ../adminIndex.php?panel=newUser");
                            }
                        } else {
                            $mysqli->close();
                            $_SESSION['warnings'] = "Entry failed";
                            header("Location: ../adminIndex.php?panel=newUser");
                        }
                    }
                    break;


// End of 4a. Adding new user ==========================================================
//======================================================================================
            endswitch; // End of $action switch
            break;
// End of 4. Users handling ============================================================
//======================================================================================              

    endswitch; // End of $source switch
} else {
    die('No source has been detected!');
}


// End of Filtering the source to use the appropriate functions - Constantine ==========
//======================================================================================
?>
