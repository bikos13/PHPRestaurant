<h4> Reservation Form</h4>
<?php

//========================================================================
// Initializing GET variables if exist - Constantine =====================
//========================================================================
   
if ((filter_input(INPUT_GET, 'userid') == null) || ((filter_input(INPUT_GET, 'email')) == null) || ((filter_input(INPUT_GET, 'fname')) == null) || ((filter_input(INPUT_GET, 'lname')) == null))
{
        echo "Insufficient parameters for reservation";
        }
        else {
            $userid = filter_input(INPUT_GET, 'userid');
            $email = filter_input(INPUT_GET, 'email');
            $fname = filter_input(INPUT_GET, 'fname');
            $lname = filter_input(INPUT_GET, 'lname');       
               
//==============================================================
// Providing options for hour select every half an hour ========
//==============================================================
    function provideHourOptionsEveryHalf() {
        $start = "14:00";
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

    $hoursArray = provideHourOptionsEveryHalf();
// Providing options for hour select every half an hour ========
//==============================================================
?>

<form role="form" method="POST" id="adminreservationform" name="adminreservationform" action="adminIndex.php?panel=setReservationTables">

    <!-- Date input field - Constantine -->
    <div class="form-group col-md-6">
        <label>ID</label>
        <input type="hidden" id="userid" value="<?php echo $userid; ?>" name="userid" class="form-control" required>
        <input type="number" id="userid" value="<?php echo $userid; ?>" name="userid" class="form-control" required disabled>
    </div>

    <div class="form-group col-md-6">
        <label>E-mail</label>
        <input type="hidden" id="email" value="<?php echo $email; ?>" name="email" class="form-control" required >
        <input type="email" id="email" value="<?php echo $email; ?>" name="email" class="form-control" required disabled>
    </div>

    <div class="form-group col-md-6">
        <label>Last Name</label>
        <input type="hidden" id="lname" value="<?php echo $lname; ?>" name="lname" class="form-control" required >
        <input type="text" id="lname" value="<?php echo $lname; ?>" name="lname" class="form-control" required disabled>
    </div>
    
    <div class="form-group col-md-6">
        <label>First name</label>
        <input type="hidden" id="fname" value="<?php echo $fname; ?>" name="fname" class="form-control" required >
        <input type="text" id="fname" value="<?php echo $fname; ?>" name="fname" class="form-control" required disabled>
    </div>

    <div class="form-group col-md-6">
        <label>Date<em style="color:red;"> *</em></label>
        <input type="date" id="date" min="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>" name="bookingdate" class="form-control" required>
    </div>

    <!-- Time input field - Constantine -->
    <div class="form-group col-md-6">
        <label>Time<em style="color:red;"> *</em></label>
        <select id="time" name="bookingtime" class="form-control" required>
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
        <input type="hidden" name="type" value="new">
        <label><button type="submit" id="submit-reservation" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span>Pick a Table</button></label>
    </div>

</form>
        <?php } ?>

