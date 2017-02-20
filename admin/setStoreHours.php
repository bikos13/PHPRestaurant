<?php

//==============================================================
// Providing options for hour select every half an hour ========
//==============================================================
$hoursArray = array();

function provideHourOptionsEveryHalf($hArray) {
    $start = "00:00";
    $end = "24:00";

    $tStart = strtotime($start);
    $tEnd = strtotime($end);
    $tNow = $tStart;

    
    while ($tNow <= $tEnd) {
        $option = date("H:i", $tNow) . "\n";
        $hArray['value'] = "<option value = '$option'>$option</option>";
        $tNow = strtotime('+30 minutes', $tNow);
    }
    return $hArray;
}

$days = array(
    'Monday',
    'Tuesday',
    'Wednesday',
    'Thursday',
    'Friday',
    'Saturday',
    'Sunday'
);

provideHourOptionsEveryHalf($hoursArray);

echo var_dump($hoursArray);

// Providing options for hour select every half an hour ========
//==============================================================
?>
<form action="functions/adminActionsProccessing.php" method="POST" name="storeHours">

    <div class = "form-group col-md-">
        <table class="table table-striped">
            <thead><th>Day</th><th>Opening Hour</th><th>Closing Hour</th><th>Closed</th></thead>
            <tbody>
                <?php
                foreach ($days as $day) {
                    foreach ($hoursArray as $timeSet) {
                        echo " ";
                    }
                }
                ?>
            </tbody>
        </table>

    </div>
</form>