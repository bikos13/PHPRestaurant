<?php
include 'functions/dbcon.php';

If (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "POST") {

    $dateDatabaseFormatted = filter_input(INPUT_POST, 'bookingdate');// Convert to database format,
    $userdata = array(
        'reservationType' => 'new',
        'lname' => filter_input(INPUT_POST, 'lname'),
        'fname' => filter_input(INPUT_POST, 'fname'),
        'userid' => filter_input(INPUT_POST, 'userid'),
        'bookingdate' =>  date("Y-m-d", strtotime($dateDatabaseFormatted)), 
        'bookingtime' => filter_input(INPUT_POST, 'bookingtime'),
        'smokingBoolean' => filter_input(INPUT_POST, 'smokingbool'),
        'reservationSize' => filter_input(INPUT_POST, 'persons'),
        'email' => filter_input(INPUT_POST, 'email')
    );
}
If (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "GET") {

    $reservationID = filter_input(INPUT_GET, 'reservationid'); // GET reservation ID to form a query for the rest of the data
    $sql = "SELECT * FROM users, booking WHERE users.USER_ID = booking.USERS_USER_ID AND BOOKING_ID = '$reservationID'";
    $result = $mysqli->query($sql);

    if ($mysqli->connect_errno) {
        die("Database Connection failed: %s\n" . $mysqli->connect_error);
        exit();
    }
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $userdata = array(
                'reservationType' => 'existing',
                'lname' => $row['LASTNAME'],
                'fname' => $row['FIRSTNAME'],
                'userid' => $row['USER_ID'],
                'bookingdate' => $row['BOOKING_DATE'],
                'bookingtime' => $row['BOOKING_TIME'],
                'smokingBoolean' => $row['SMOKING_BOOL'],
                'reservationSize' => $row['BOOKING_SIZE'],
                'email' => $row['EMAIL']
            );
        }
    } else {
        $mysqli->close();
        die("No reservation ID Detected");
    }
}
?>

<h3> Assign a table(s)</h3>
<h3><small>for <?php echo $userdata['lname'] . " " . $userdata['fname']; ?> 's Reservation <?php (((isset($reservationID) === TRUE) && ($reservationID != null)) ? print(" <strong>with ID: #$reservationID</strong>") : ""); ?></small></h3>
<h3><small>The reservation Size is for <strong style="color: blueviolet"><?php echo $userdata['reservationSize']; ?> PERSONS</strong></small></h3>

<?php

//========================================================================
// Function that generates checkbox tables - Constantinoe ================
//========================================================================

function tableCheckbox($tableCode, $tableSize) {
    $button = "<div class='col-md-1'><table class='table table-bordered' style='margin-top:5px; text-align: center;'><theadd><th>" . $tableCode . "</th></thead><tbody><tr><td><input type='checkbox' name='tableSelected$tableCode' value='$tableCode'></td></tr><tr><td>" . $tableSize . "</td></tr></tbody></table></div>";
    return $button;
}

// End of Function that generates checkbox tables ========================
//========================================================================
//========================================================================
// Function that generates checkbox tables THAT ARE RESERVED - Constantine =
//========================================================================

function tableCheckboxReserved($tableCode, $tableSize) {
    $button = "<div class='col-md-1'><table class='table table-bordered' style='margin-top:5px; text-align: center; color:red;'><theadd><th>" . $tableCode . "</th></thead><tbody><tr><td><input type='checkbox' title='This table is reserved!' name='tableSelected$tableCode' value='$tableCode' disabled></td></tr><tr><td>" . $tableSize . "</td></tr></tbody></table></div>";
    return $button;
}

// End of Function that generates checkbox tables THAT ARE RESERVED 
//========================================================================
//========================================================================
// Part of the final Query that finds bookings between 3 hours ahead or before (to be used in eliminating booked tables) - Constantinoe 
//========================================================================
$threeHoursBefore = date('G:i:s', strtotime($userdata['bookingtime']) - 10800); //preparing hour range for the query  minus 3 hours
$threeHoursLater = date('G:i:s', strtotime($userdata['bookingtime']) + 10800); //preparing hour range for the query  plus 3 hours

//
//
//*****************************************************************************************************
//===================== Mistake #1 I must concatenate datetime value for DB Usage, because overnight bookings are considered earlier (due to the fact of date lacking) if I don't =====
$absolutethreeHoursBefore = date('G',strtotime($threeHoursBefore)); // Making hours absolute so we can use them for comparison else the comparison below won't work
$absolutethreeHoursLater = date('G',strtotime($threeHoursLater)); // Making hours absolute so we can use them for comparison


If ($absolutethreeHoursBefore > $absolutethreeHoursLater) { //If I have handled the date and time values as one, I wouldn't need this kind of fix :( (Now I know) - Constantine
    $threeHoursLater = "23:59:59";
}
//===================== End of Mistake #1 =============================================================================================================================================
//*****************************************************************************************************
//
//
//

$hoursrangeQueryScript = "BOOKING_TIME BETWEEN " . $threeHoursBefore . " AND " . $threeHoursLater . " "; //script that defines hour range for the query
// End of Part of the final Query that finds bookings between 3 hours ahead or before  ==========
//========================================================================



//=================================================================================
// Query Script based on smoking pref and table availability - Constantine ========
//=================================================================================


$sqlGeneratedScript = "SELECT * FROM tables, booking, tables_booked
WHERE booking.BOOKING_ID = tables_booked.Booking_BOOKING_ID AND
tables.TABLE_CODE = tables_booked.TABLES_TABLE_CODE AND
SMOKING = '" . $userdata['smokingBoolean'] . "' AND
BOOKING_DATE = '" . $userdata['bookingdate'] . "' AND 
BOOKING_TIME BETWEEN '" . $threeHoursBefore . "' AND '" . $threeHoursLater . "'
ORDER BY BOOKING_ID";
$eliminatedTables = $mysqli->query($sqlGeneratedScript);

$eliminatedTablesArray = array(); // array that will collect eliminated tables from Query - Constantine

if ($eliminatedTables->num_rows > 0) {
    $i = 1;

    while ($row = $eliminatedTables->fetch_assoc()) {
        $eliminatedTablesArray[$i] = $row['TABLE_CODE'];
        $i++;

    }
}



// End of Query Script based on smoking pref and table availability ===============
//=================================================================================
?>
<div class="col-md-12">
    <form method="POST" action="adminIndex.php?panel=reservationConfirmation">
        <?php
//==============================================================================       
// Filtering tables based on smoking preferation ===============================
//============================================================================== 
        if ($userdata['smokingBoolean'] === '1') {
            echo "<h4><small>Assign tables from <strong style='color:blue;'>Smoking</strong> Area!</small><h4>";
            $sql = "SELECT TABLE_CODE, TABLE_SIZE FROM `tables` WHERE SMOKING = '1'";
            $result = $mysqli->query($sql);
            while ($row = $result->fetch_assoc()) {
                if (!(in_array($row['TABLE_CODE'], $eliminatedTablesArray))) { //Eliminating reserved tables - Constantine
                    echo tableCheckbox($row['TABLE_CODE'], $row['TABLE_SIZE']);
                } else {
                    echo tableCheckboxReserved($row['TABLE_CODE'], $row['TABLE_SIZE']);
                }
            }
        } else {
            echo "<h4><small>Assign tables from <strong style='color:red;'>NON-Smoking</strong> Area</small></h4>";
            $sql = "SELECT TABLE_CODE, TABLE_SIZE FROM `tables` WHERE SMOKING = '0'";
            $result = $mysqli->query($sql);
            while ($row = $result->fetch_assoc()) {
                if (!(in_array($row['TABLE_CODE'], $eliminatedTablesArray))) { //Eliminating reserved tables - Constantine
                    echo tableCheckbox($row['TABLE_CODE'], $row['TABLE_SIZE']);
                } else {
                    echo tableCheckboxReserved($row['TABLE_CODE'], $row['TABLE_SIZE']);
                }
            }
        }

// End of Filtering tables based on smoking preferation ========================
//============================================================================== 

//============================================================================== 
// Filling form data from input method - Constantine =========================== 
//============================================================================== 
        
        If (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "POST") {
            foreach ($userdata as $key => $value) {
                echo "<input type='hidden' name='$key' value='$value'>";
            }
        }
        If (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "GET") {
            foreach ($userdata as $key => $value) {
                echo "<input type='hidden' name='$key' value='$value'>";
            }
            echo "<input type='hidden' name='reservationID' value='$reservationID'>";
        }
        $mysqli->close();
        
// End of Filling form data from input method ================================== 
//============================================================================== 
        
        ?>

        
        
        <div class="col-md-12">
            <button class="btn btn-default" type="submit">Review Reservation</button>
        </div>
    </form>
</div>
