<h3 class="hidden-sm hidden-xs">Reservations History</h3>
<!-- Reservations Main Area - Constantine -->
<?php
include "./functions/dbcon.php";

//============================================================================================================
//Creating Pagination Variables - Constantine ================================================================
//============================================================================================================

$rowsperpage = 10; //Pagination Results per page that i want to view
$pageCleanInput = test_GET_page($_GET['page']); //Collecting page number from get and validating input
$pageMinusOne = $pageCleanInput - 1; // Subtracting 1 so when page is 1 the reult will define as index 0 using the pr variable
$pr = $pageMinusOne * $rowsperpage; // Indicating SQL query index in LIMIT
$next_page = $pageCleanInput + 1; //Next page Button Variable
$prv_page = $pageCleanInput - 1; //Previous page Button Variable

//End of Creating Pagination Variables =======================================================================
//============================================================================================================



//============================================================================================================
//Function to create a pagination button inputs: target page number and button's text - Constantine ==========
//============================================================================================================

function pagBut($page_number, $buttontext) {
    echo "<a class='btn btn-default' style='margin:5px; !important' href='profile.php?panel=viewReservations&page=" . $page_number . "'> " . $buttontext . " </a>";
}

// End of Pagination Button Function =========================================================================
//============================================================================================================



//============================================================================================================
//Main query to get users reservation history - Constantine ==================================================
//============================================================================================================

$sql = "SELECT * FROM booking, booking_status WHERE ((BOOKING_DATE < CURDATE() AND USERS_USER_ID = " . $_SESSION['userdata']['userid'] . ") OR booking_status_B_STATUS_ID = '3') AND booking.booking_status_B_STATUS_ID = booking_status.B_STATUS_ID ORDER BY BOOKING_ID DESC LIMIT " . $pr . "," . $rowsperpage;
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table table-bordered' style='margin:0 !important;'><tr><thead><th>ID</th><th>Date</th><th>Time</th><th>Table Size</th><th>Smoking area</th><th>Status</th></thead></tr>";
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $smokers = "no";
        if ($row["SMOKING_BOOL"] == "1") {
            $smokers = "yes";
        }

        echo "<tr><td>" . $row["BOOKING_ID"] . "</td><td>" . $row["BOOKING_DATE"] . "</td><td>" . $row["BOOKING_TIME"] . "</td><td>" . $row["BOOKING_SIZE"] . "</td><td>" . $smokers . "</td><td>" . $row["B_STATUS_NAME"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

//End of Main query to get users reservation history =========================================================
//============================================================================================================


//============================================================================================================
//Quering result pages number to utilize pagination button (when to show or hide) - Constantine ==============
//============================================================================================================

$sql_pagin = "SELECT BOOKING_ID, BOOKING_DATE, BOOKING_TIME, BOOKING_SIZE, SMOKING_BOOL FROM booking WHERE USERS_USER_ID =" . $_SESSION['userdata']['userid']; //query to return pagination size
$result1 = $mysqli->query($sql_pagin);
$count_results = mysqli_num_rows($result1);
$check_pages_size = $pr + $rowsperpage;
$pagelimit = ceil($count_results / $rowsperpage); // Indicates the number of pages the query returned ceiled

//End of Quering result pages number to utilize pagination button (when to show or hide) - Constantine =======
//============================================================================================================



//============================================================================================================
//Paginations buttons creations through function and query  - Constantine ====================================
//============================================================================================================

if ($pageCleanInput > 1) {
    pagBut("1", "Most Recent Reservations");
    pagBut($prv_page, "Previous Page");
}
if ($count_results > $check_pages_size) {
    pagBut($next_page, "Next Page");
    pagBut($pagelimit, "Oldest Reservations");
}

echo "<br>Page $pageCleanInput from  $pagelimit<br>";

$mysqli->close(); //Closing Database connection

//End of Paginations buttons creations through function and query  - Constantine =============================
//============================================================================================================
?>

