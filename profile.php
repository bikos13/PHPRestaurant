<!--Page Meta - Constantine -->
<!--TITLE Constant is being used for the header <title> tag and also for the 'mobileTitle'  mobile version of class which echoes TITLE-->
<?php define('TITLE', 'Profile'); ?>
<!-- Page Meta - Constantine -->
<?php include('includes/header.php'); ?>

<?php if ((isset($_SESSION['loggedin'])) && ($_SESSION['loggedin'] = true)) { //Only for loggedin validation - Constantine ?>
    <div class="row">

        <?php include 'memberIncludes/ProfileMenu.php'; //Including the usermenu from membersIncludes - Constantine ?> 

        <div class="col-md-9"> <!-- Profile Main Area - Constantine -->
            <div class="box">
                <div class="col-md-3">
                    <img src="img/felipe.png" alt="Felipe" style="width:100%;">
                </div>
                <div class="col-md-9">
                    <h3>Felipe says:</h3>
                    <?php
                    // Message for successful alert - Constantine ============================================
                    if (isset($_SESSION['reservationmessage'])) {
                        echo "<div class='alert alert-success'>" . $_SESSION['reservationmessage'] . "</div>";
                        unset($_SESSION['reservationmessage']);
                    }
                    // End of succesful message alert =======================================================
                    ?>
                    
                    <blockquote aria-label="testimonial-comment">
                        <?php
                        //Show upcoming reservation if exists using SQL query, else show default Landing page - Constantine =========================
                        include 'functions/dbcon.php'; // Connecting to database - Constantine 
                        $upcomingReservationsSql = "SELECT BOOKING_ID, BOOKING_DATE, BOOKING_TIME, BOOKING_SIZE, SMOKING_BOOL FROM booking WHERE BOOKING_DATE >= CURDATE() AND USERS_USER_ID = " . $_SESSION['userdata']['userid'];
                        $result = $mysqli->query($upcomingReservationsSql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "Hello there mate! Looks like you have a reservation on <br><strong>" . date('l d-m-Y', strtotime($row['BOOKING_DATE'])) . " and at " . $row['BOOKING_TIME'] . "</strong>. To cancel a reservation please call +30 26130 55055";
                            }
                        } else {
                            include 'memberIncludes/withoutReservation.php'; //If not reservations are made bring up this screen - Constantine
                        }
                        //============================================================================================================================
                        $mysqli->close();
                        ?>

                    </blockquote>
                    
                    <div class="col-md-6">
                        <a href="#" data-toggle="tooltip" title="To cancel a reservation please call +30 26130 55055"> <button class="btn btn-lg disabled"><span class="glyphicon glyphicon-glass"></span><br>Cancel reservation</button></a>
                    </div>
                    
                    <div class="col-md-6">
                        <a href="ReservationsHistory.php?page=1"><button class="btn btn-lg profilebtn"><span class="glyphicon glyphicon-book"></span><br>View Reservations History</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    </body>

    </html>
    <?php
} else { //If not loggedin redirect to login page with message
    $_SESSION['warnings'] = "You have to be logged in to access the profile page";
    header("Location: login.php");
}
?>