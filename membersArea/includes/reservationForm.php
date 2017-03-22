<?php

//==============================================================
// Providing options for hour select every hour - Constantine ==
//==============================================================
function provideHourOptions() {
    $start = "16:00";
    $end = "23:00";
    $array = array();
    $tStart = strtotime($start);
    $tEnd = strtotime($end);
    $tNow = $tStart;

    $i = 1;
    while ($tNow <= $tEnd) {
        $option = date("H:i", $tNow);
        $array[$i] = $option;
        $tNow = strtotime('+60 minutes', $tNow);
        $i++;
    }
    return $array;
}

$hoursArray = provideHourOptions();
// End of Providing options for hour select every hour =========
//==============================================================
?>

<form role="form" method="POST" id="reservationform" name="reservationform" action="functions/reservationhandling.php">
    <input type="hidden" name="userid" value="<?php echo $_SESSION['userdata']['userid']; // Passing User_ID from session variable     ?>">

    <!-- Date input field - Constantine -->
    <div class="form-group col-md-6">
        <label>Date<em style="color:red;"> *</em></label>
        <input type="text" id="datepicker" name="bookingdate" class="form-control" required>
    </div>

    <!-- Time input field - Constantine -->
    <div class="form-group col-md-6">
        <label>Time<em style="color:red;"> *</em></label>
        <select id="time" name="bookingtime" step="1800" class="form-control" required>
            <?php
            foreach ($hoursArray as $hour) {
                echo "<option value='$hour:00'>" . $hour . "</option>";
            }
            ?>
        </select>
    </div>
    <!-- Persons input field - Constantine -->
    <div class="form-group col-md-6">
        <label>How many persons?<em style="color:red;"> *</em></label>
        <select name="persons" class="form-control centered">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option disabled>Για παραπάνω από 8 άτομα καλέστε μας στο 26130 55055</option>
        </select>
    </div>

    <!-- Smokers or non-smokers input field - Constantine -->
    <div class="form-group col-md-6">
        <div class="form-group col-md-12">
            <label>Where would you like your table?<em style="color:red;"> *</em></label>
        </div>
        <div class="form-group col-md-6">
            <input type="radio" id="smoking" name="smokingbool" value="0" checked="checked" required><strong>Non</strong> Smoking Area
        </div>
        <div class="form-group col-md-6">
            <input type="radio" id="smoking" name="smokingbool" value="1" required>Smoking Area
        </div>
    </div>

    <!-- Submit Button - Constantine -->
    <div class="form-group col-md-12">
        <input type="hidden" name="reservationform" value="TRUE">
        <label><button type="submit" id="submit-reservation" name="submit-reservation" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> Submit reservation</button></label>
    </div>

</form>

<script>
  $( function() {
    $( "#datepicker" ).datepicker({
    currentText: "Now",
    dateFormat: "dd-mm-yy",
    defaultDate: 0,
    minDate: 0
    }); 
} );
  </script>