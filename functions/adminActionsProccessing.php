<h1>Proccessing Information</h1>
<?php
// Starting Session - Constantine
session_start();
//Including Database Connection function - Constantine
include "dbcon.php";

//Including validation.php functions - Constantine
include "validations.php";


$source = filter_input(INPUT_GET, 'source'); // This variable holds the source page that wants to use the action proccessing page - Constantine
$action = filter_input(INPUT_GET, 'action'); // This variable holds the main action to be used - Constantine
$id = filter_input(INPUT_GET, 'id'); // This variable holds the id will be used for manipulation - Constantine
//======================================================================================
// Filtering the source to use the appropriate functions and operations - Constantine ==
//======================================================================================


If ($source != null) { // Checking if the source is valid
    switch ($source):




//======================================================================================
// Tables Case and Actions - Constantine ===============================================
//======================================================================================
        case('tables'):
            $id = strtoupper($id); // Capitalizing input - Constantine

            switch ($action):

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

                default :
                    $_SESSION['warnings'] = "Wrong input detected";
                    header('Location: ../adminIndex.php?panel=manageTables&page=1');
                    break;
            endswitch;

            break;

// End of Tables Case and actions ======================================================
//======================================================================================
//======================================================================================
// Setting hours function - Constantine ================================================
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

// End of Setting hours function - Constantine =========================================
//======================================================================================
//
//
//
//======================================================================================
// Cancel Reservation - Constantine ====================================================
//======================================================================================          
        case('reservations'):
            switch ($action):
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
// End of Function to cancel a reservation ===================================================================
//============================================================================================================

                    
//============================================================================================================
// Cancel old pending reservations - Constantine =============================================================
//============================================================================================================                    
                case('cancelOldPendingReservations'):
                    $sqlclearOld = "UPDATE `booking` SET `booking_status_B_STATUS_ID`='4' WHERE `booking_status_B_STATUS_ID`='1' AND BOOKING_DATE < CURDATE()";
                    $result2 = $mysqli->query($sqlclearOld);
                    $affectedRecords = $mysqli->affected_rows;
                    if ($affectedRecords > 0) {
                        $_SESSION['successmessage'] = "You have succesfully changed the status of <strong>$affectedRecords pending</strong> reservations to <strong>Unattended</strong>";
                    }
                    else{
                        $_SESSION['successmessage'] = "There weren't any unattended reservations to proccess!";
                    }
                    $mysqli->close();
                    header('Location: ../adminIndex.php?panel=viewReservations&page=1');
                    break;
            endswitch;
            break;



        case('viewReservations'):
//============================================================================================================
// End of Cancel old pending reservations  ===================================================================
//============================================================================================================





    endswitch; // End of $source switch
} else {
    die('No source has been detected!');
}


// End of Filtering the source to use the appropriate functions - Constantine ==========
//======================================================================================
//======================================================================================
// Cancel Reservation - Constantine ====================================================
//======================================================================================
?>
