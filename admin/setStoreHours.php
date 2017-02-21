<div class="col-md-12" style="border: 1px solid grey; padding-bottom: 20px; margin-bottom: 20px;">
<h3>Current Open Hours</h3>

    <?php
//Calling phpstorehours.php a plugin developed by Cory Etzkorn (More in the Report) - Constantine
    include_once('includes/phpstorehours.php');
    echo '<div class="col-md-4 col-md-offset-4">';
    echo '<table class="table table-striped" style="margin:0;">';
    foreach ($store_hours->hours_this_week() as $days => $hours) {
        echo '<tr>';
        echo '<td>' . $days . '</td>';
        echo '<td>' . $hours . '</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';
    ?>
</div>

<div class="col-md-12" style="border: 1px solid grey; padding-bottom: 20px;">
    <h3>Set NEW Open Hours</h3>
    <?php

//==============================================================
// Providing options for hour select every half an hour ========
//==============================================================
    function provideHourOptionsEveryHalf() {
        $start = "00:00";
        $end = "24:00";
        $array = array();
        $tStart = strtotime($start);
        $tEnd = strtotime($end);
        $tNow = $tStart;

        $i = 1;
        while ($tNow <= $tEnd) {
            $option = date("H:i", $tNow);
            $array[$i] = $option;
            $tNow = strtotime('+30 minutes', $tNow);
            $i++;
        }
        return $array;
    }

    $days = array(
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
        "Sunday"
    );

    $hoursArray = provideHourOptionsEveryHalf();
// Providing options for hour select every half an hour ========
//==============================================================
    ?>

    <form action="functions/adminActionsProccessing.php" method="GET" name="hours">
        <table class="table" style="margin:0px;">
            <thead><th>Day</th><th>Opening Hour</th><th>Closing Hour</th><th>Closed</th></thead><tbody>
                <?php foreach ($days as $day) { ?>
                    <tr><td><?php echo $day; ?></td><td><select class="form-control" name="<?php echo $day; ?>Open"><?php
                foreach ($hoursArray as $hour) {
                    echo "<option value='$hour'>" . $hour . "</option>";
                }
                    ?></select></td><td><select class="form-control" name="<?php echo $day; ?>Close"><?php
                                foreach ($hoursArray as $hour) {
                                    echo "<option value='$hour'>" . $hour . "</option>";
                                }
                                ?></select></td><td><input type="checkbox" name ="<?php echo $day; ?>Closed"></td></tr>
                                    <?php } ?>
            </tbody>
        </table>
        <input type="hidden" name="source" value="setHours">
        <input type="hidden" name="action" value="set">
        <button type="submit" class="btn btn-success btn-lg" style="margin-top: 20px;">Submit New Hours</button>
    </form>


</form>
</div>