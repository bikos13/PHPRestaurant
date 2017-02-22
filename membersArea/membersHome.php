<div class="col-md-3">
    <img class="hidden-sm" src="img/felipe.png" alt="Felipe" style="width:100%;">
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
                        $upcomingReservationsSql = "SELECT * FROM booking WHERE BOOKING_DATE >= CURDATE() AND booking_status_B_STATUS_ID !='3' AND USERS_USER_ID = " . $_SESSION['userdata']['userid'];
                        $result = $mysqli->query($upcomingReservationsSql);
                        if ($result->num_rows > 0) {
                            include 'includes/withreservation.php'; //If there is an existing future reservation - Constantine
                        } else {
                            include 'includes/withoutReservation.php'; //If not reservations are made bring up this screen - Constantine
                        }
                        //============================================================================================================================
                        $mysqli->close();
                        ?>

                    </blockquote>

                </div>