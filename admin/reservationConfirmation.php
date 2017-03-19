<h3>REVIEWING RESERVATION INFO</h3>

<?php
$userdata = filter_input_array(INPUT_POST); //Collecting $_POST data in a $userdata array - Constantine
$tablesReserved = array(); // Initializing reserved tables array - Constantine

include 'functions/fetchAssignedTables.php'; //Calling table fetching function - Constantine

$tablesReserved = collectAssignedTables($userdata); // Filling the tablesReserved array through the function - Constantine

?>
<div class="col-md-6 col-md-offset-3 box">
    <div class="text-left">
        <div class="col-md-12">Name:<strong> <?php echo $userdata['lname'] . " " . $userdata['fname']; ?></strong></div>
        <div class="col-md-12">E-mail:<strong> <?php echo $userdata['email']; ?></strong></div>
        <div class="col-md-12">Reservation Size:<strong> <?php echo $userdata['reservationSize'] . " persons " . ( $userdata['smokingBoolean'] === '1' ? ' in Smoking Area' : ' in <strong>NON</strong>-Smoking Area' ) ?></strong></div>
        <div class="col-md-12">Date:<strong> <?php echo $userdata['bookingdate']; ?></strong></div>
        <div class="col-md-12">Time:<strong> <?php echo $userdata['bookingtime']; ?></strong></div>
        <div class="col-md-12">Reserved Tables: <?php foreach ($tablesReserved as $key => $value) {
    echo " <strong> " . $value . " </strong>";
} ?></div>
        <form method="POST" action="../functions/adminActionsProccessing.php">
            <?php
            If (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "POST") {
            foreach ($userdata as $key => $value) {
                echo "<input type='hidden' name='$key' value='$value'>";
            }
            echo "<input type='hidden' name='source' value='reservations'>";
            echo "<input type='hidden' name='action' value='insertReservation'>";
        }
            ?>
        <div class="col-md-12">&nbsp;</div>
        <div class="col-md-6"><button class="btn btn-success" type="submit"> Confirm Reservation </button></div>
        <div class="col-md-6"><button class="btn btn-danger" type="submit" name="reservationReset"> Restart Reservation </button></div>
        </form>
    </div>
</div>
