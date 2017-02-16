<?php

//==============================================================
// Providing options for hour select every half an hour ========
//==============================================================

function provideHourOptionsEveryHalf() {
    $start = "00:00";
    $end = "24:00";

    $tStart = strtotime($start);
    $tEnd = strtotime($end);
    $tNow = $tStart;

    while ($tNow <= $tEnd) {
        $option = date("H:i", $tNow) . "\n";
        echo "<option value = '$option'>$option</option>";
        $tNow = strtotime('+30 minutes', $tNow);
    }
}

// Providing options for hour select every half an hour ========<option value = "1">1</option>
//==============================================================
?>
<form action="functions/adminActionsProccessing.php" method="POST" name="storeHours">

    <div class = "form-group col-md-">
        <table class="table table-striped">
            <thead><th>Day</th><th>Opening Hour</th><th>Closing Hour</th><th>Closed</th></thead>
        <tbody>
        
        </tbody>
        </table>
        <label>Monday<br>Start time: <select name = "MonOp" class = "form-control">
                <?php provideHourOptionsEveryHalf() ?>
            </select>Closing Time
            <select name = "MonCl" class = "form-control">
                <?php provideHourOptionsEveryHalf() ?>

            </select>
        </label>
    </div>
</form>