<?php
include 'functions/dbcon.php';

If (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "POST") {

    $userdata = array(
        'reservationType' => 'new',
        'lname' => filter_input(INPUT_POST, 'lname'),
        'fname' => filter_input(INPUT_POST, 'fname'),
        'userid' => filter_input(INPUT_POST, 'userid'),
        'bookingdate' => filter_input(INPUT_POST, 'bookingdate'),
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
echo "<pre>";
echo var_dump($userdata);
echo "</pre>";


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
                echo tableCheckbox($row['TABLE_CODE'], $row['TABLE_SIZE']);
            }
        } else {
            echo "<h4><small>Assign tables from <strong style='color:red;'>NON-Smoking</strong> Area</small></h4>";
            $sql = "SELECT TABLE_CODE, TABLE_SIZE FROM `tables` WHERE SMOKING = '0'";
            $result = $mysqli->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo tableCheckbox($row['TABLE_CODE'], $row['TABLE_SIZE']);
            }
        }
        
// End of Filtering tables based on smoking preferation ========================
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
        ?>
</div>
<div class="col-md-12">
    <button class="btn btn-default" type="submit">Review Reservation</button>
</div>
</form>

