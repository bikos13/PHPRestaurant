<!--
===========================================================================
Description - Constantine
This panel is used when the user have already one future reservation
profile.php utilizes this in both home and newReservation panel hooks
===========================================================================
-->

<?php
while ($row = $result->fetch_assoc()) {
    echo "<div class='col-md-12'>";
    echo "<blockquote aria-label='testimonial-comment'>";
    echo "Hello there mate! Looks like you have a reservation on <br><strong>" . date('l d-m-Y', strtotime($row['BOOKING_DATE'])) . " and at " . $row['BOOKING_TIME'] . "</strong>. To cancel a reservation please call +30 26130 55055<br>";
    echo "<br><br>";
    if ($row['booking_status_B_STATUS_ID'] === '1') {
        echo "Reservation Status: <strong style='color:red;'> Pending </strong> <br><small>Our reservation service will contact you for confirmation shortly.</small>";
    }
    elseif ($row['booking_status_B_STATUS_ID'] === '2') {
        echo "Reservation Status: <strong style='color:green;'> Approved </strong> <br><small>That means, that we are expecting you!</small>";
    }
    echo "</div></blockquote>";
    echo "<br><br>";
    ?>

    <div class = "col-md-6">
        <a href = "#" data-toggle = "tooltip" title = "To cancel a reservation please call +30 26130 55055"> <button class = "btn btn-lg disabled"><span class = "glyphicon glyphicon-glass"></span><br>Cancel reservation</button></a>
    </div>

    <div class = "col-md-6">
        <a href = "profile.php?panel=viewReservations&page=1"><button class = "btn btn-lg profilebtn"><span class = "glyphicon glyphicon-book"></span><br>View Reservations History</button></a>
    </div>
</div>
<!-- Tooltip script used for tooltip title -->
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
<!-- End of tooltip script -->

    <?php
}
?>