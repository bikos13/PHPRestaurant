<h3 class="hidden-sm hidden-xs">Make a reservation</h3>

                <?php
                //Show upcoming reservation if exists using SQL query, else show default Landing page - Constantine =========================
                include 'functions/dbcon.php'; // Connecting to database - Constantine 
                $upcomingReservationsSql = "SELECT BOOKING_ID, BOOKING_DATE, BOOKING_TIME, BOOKING_SIZE, SMOKING_BOOL FROM booking WHERE BOOKING_DATE >= CURDATE() AND USERS_USER_ID = " . $_SESSION['userdata']['userid']. " AND`booking_status_B_STATUS_ID` = '1' OR `booking_status_B_STATUS_ID` = '2'";
                $result = $mysqli->query($upcomingReservationsSql);
                if ($result->num_rows > 0) { 
                    
                    include 'includes/withreservation.php'; //If there is an existing future reservation - Constantine
                } else {
                    include 'includes/reservationForm.php'; //If not reservations are made bring up this screen - Constantine
                }
                //============================================================================================================================
                $mysqli->close();
                ?>