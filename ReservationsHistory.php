<!--Page Meta - Constantine -->
<!--TITLE Constant is being used for the header <title> tag and also for the 'mobileTitle'  mobile version of class which echoes TITLE-->
<?php
define('TITLE', 'Reservations History');
//Including Database Connection function - Constantine
include "./functions/dbcon.php";
include "./functions/validations.php";
?>

<!-- Page Meta - Constantine -->
<?php include('includes/header.php'); ?>
<?php if ((isset($_SESSION['loggedin'])) && ($_SESSION['loggedin'] = true)) { //Only for loggedin validation - Constantine  ?>
    <div class="row">

        <?php include 'memberIncludes/ProfileMenu.php'; //Including the usermenu from membersIncludes - Constantine  ?> 

        <div class="col-md-9">

            <div class="box">
                <h3 class="hidden-sm hidden-xs">Reservations History</h3>
                <!-- Reservations Main Area - Constantine -->
                <?php
                //Creating Pagination Variables - Constantine =======================
                $rowsperpage = 10; //Pagination Results per page
                $pageCleanInput = test_GET_page($_GET['page']); //Collecting page number from get and validating input
                $pageMinusOne = $pageCleanInput - 1; // Subtracting 1 so when page is 1 the reult will define as index 0 using the pr variable
                $pr = $pageMinusOne * $rowsperpage; // Indicating SQL query index in LIMIT
                $next_page = $pageCleanInput + 1; //Next page Button Variable
                $prv_page = $pageCleanInput - 1; //Previous page Button Variable
                //==================================================================

                $sql = "SELECT BOOKING_ID, BOOKING_DATE, BOOKING_TIME, BOOKING_SIZE, SMOKING_BOOL FROM booking WHERE BOOKING_DATE < CURDATE() AND USERS_USER_ID = " . $_SESSION['userdata']['userid'] . " ORDER BY BOOKING_ID DESC LIMIT " . $pr . "," . $rowsperpage;
                $result = $mysqli->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table class='table table-bordered' style='margin:0 !important;'><tr><thead><th>ID</th><th>Date</th><th>Time</th><th>Table Size</th><th>Smoking area</th></thead></tr>";
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $smokers = "no";
                        if ($row["SMOKING_BOOL"] == "1") {
                            $smokers = "yes";
                        }

                        echo "<tr><td>" . $row["BOOKING_ID"] . "</td><td>" . $row["BOOKING_DATE"] . "</td><td>" . $row["BOOKING_TIME"] . "</td><td>" . $row["BOOKING_SIZE"] . "</td><td>" . $smokers . "</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "0 results";
                }
                //Creating Dynamic Pagination Buttons  - Constantine =========================================================
                $sql_pagin = "SELECT BOOKING_ID, BOOKING_DATE, BOOKING_TIME, BOOKING_SIZE, SMOKING_BOOL FROM booking WHERE USERS_USER_ID =" . $_SESSION['userdata']['userid']; //query to return pagination size
                $result1 = $mysqli->query($sql_pagin);
                $count_results = mysqli_num_rows($result1);
                $check_pages_size = $pageCleanInput + $rowsperpage;
                $pagelimit = ceil($count_results / $rowsperpage); // Indicates the number of pages the query returned ceiled
                
                //Function to create a pagination button inputs: target page number and button's text

                function pagBut($page_number, $buttontext) {
                    echo "<a class='btn btn-default' style='margin:5px; !important' href='reservationsHistory.php?page=" . $page_number . "'> " . $buttontext . " </a>";
                }

                //Button Function End

                if ($pageCleanInput > 1) {
                    pagBut("1", "Most Recent Reservations");
                    pagBut($prv_page, "Previous Page");
                }
                if ($count_results > $check_pages_size) {
                    pagBut($next_page, "Next Page");
                    pagBut($pagelimit, "Oldest Reservations");
                }

                $mysqli->close(); //Closing Database connection
                ?>

            </div>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>

    </body>

    </html>
    <?php
} else { //If not loggedin redirect to login page with message
    $_SESSION['warnings'] = "You have to be logged in to access the reservations history page";
    header("Location: login.php");
}
?>