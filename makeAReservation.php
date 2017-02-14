<!--Page Meta - Constantine -->
<!--TITLE Constant is being used for the header <title> tag and also for the 'mobileTitle'  mobile version of class which echoes TITLE-->
<?php define('TITLE', 'Make a Reservation'); ?>
<!-- Page Meta - Constantine -->
<?php include('includes/header.php'); ?>

<?php if ((isset($_SESSION['loggedin'])) && ($_SESSION['loggedin'] = true)) { //Only for loggedin validation - Constantine ?>
    <div class="row">

        <?php if (isset($_SESSION['reservationmessage'])) { // View passed success messages - Constantine ?>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-success"><?php echo $_SESSION['reservationmessage']; ?></div>
                </div>
            </div>
            <?php
            unset($_SESSION['reservationmessage']);
        }
        ?>

    <?php include 'memberIncludes/ProfileMenu.php'; //Including the usermenu from membersIncludes - Constantine    ?> 

        <div class="col-md-9"> <!-- Reservation Main Area - Constantine -->
            <div class="box">
                <h3 class="hidden-sm hidden-xs">Make a reservation</h3>

                <?php
                //Show upcoming reservation if exists using SQL query, else show default Landing page - Constantine =========================
                include 'functions/dbcon.php'; // Connecting to database - Constantine 
                $upcomingReservationsSql = "SELECT BOOKING_ID, BOOKING_DATE, BOOKING_TIME, BOOKING_SIZE, SMOKING_BOOL FROM booking WHERE BOOKING_DATE >= CURDATE() AND USERS_USER_ID = " . $_SESSION['userdata']['userid'];
                $result = $mysqli->query($upcomingReservationsSql);
                if ($result->num_rows > 0) { 
                    
                    include 'memberIncludes/withreservation.php'; //If there is an existing future reservation - Constantine
                } else {
                    include 'memberIncludes/reservationForm.php'; //If not reservations are made bring up this screen - Constantine
                }
                //============================================================================================================================
                $mysqli->close();
                ?>


            </div> <!-- End of box - Constantine -->

        </div> <!-- End of column section - Constantine -->

    </div> <!-- End of row - Constantine -->

    <?php include('includes/footer.php'); ?>

    </body>

    </html>
    <?php
} else { //If not loggedin redirect to login page with message
    $_SESSION['warnings'] = "You have to be logged in to access the reservations page";
    header("Location: login.php");
}
?>