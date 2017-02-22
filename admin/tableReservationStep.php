<?php
$userdata = array(
    'lname' => filter_input(INPUT_POST, 'lname'),
    'fname' => filter_input(INPUT_POST, 'fname'),
    'userid' => filter_input(INPUT_POST, 'userid'),
    'bookingdate' => filter_input(INPUT_POST, 'bookingdate'),
    'bookingtime' => filter_input(INPUT_POST, 'bookingtime'),
    'smokingBoolean' => filter_input(INPUT_POST, 'smokingbool'),
    'reservationSize' => filter_input(INPUT_POST, 'persons'),
    'email' => filter_input(INPUT_POST, 'email')
);
?>

<h3> Assign a table(s)</h3>
<h3><small>for <?php echo $userdata['lname'] . " " . $userdata['fname']; ?> 's Reservation</small></h3>
<h3><small>The reservation Size is for <strong style="color: blueviolet"><?php echo $userdata['reservationSize']; ?> PERSONS</strong></small></h3>

<?php
include 'functions/dbcon.php';

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
// Smokers and non smokers tables will appear based on $smoking boolean
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
foreach ($userdata as $key => $value) {
    echo "<input type='hidden' name='$key' value='$value'>";
}
$mysqli->close();
?>
</div>
<div class="col-md-12">
    <button class="btn btn-default" type="submit">Review Reservation</button>
</div>
</form>

