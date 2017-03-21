<h3 class="hidden-sm hidden-xs">Make a reservation</h3>

                <?php
                //Show upcoming reservation if exists using SQL query, else show default Landing page - Constantine =========================
                include 'functions/dbcon.php';
                $upcomingReservationsSql = "SELECT * FROM booking WHERE ((BOOKING_DATE >= CURDATE() AND `booking_status_B_STATUS_ID` = '1') OR (BOOKING_DATE >= CURDATE() AND `booking_status_B_STATUS_ID` = '2')) AND USERS_USER_ID = " . $_SESSION['userdata']['userid']. " ";
                $result = $mysqli->query($upcomingReservationsSql);
                if ($result->num_rows > 0) { 
                    
                    include 'includes/withReservation.php'; //If there is an existing future reservation - Constantine
                } else {
                    include 'includes/reservationForm.php'; //If not reservations are made bring up this screen - Constantine
                }
                //============================================================================================================================
                $mysqli->close();
                ?>