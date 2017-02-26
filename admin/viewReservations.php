<h4>View Reservations</a></h4>

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
    echo "<a class='btn btn-default' style='margin:5px; !important' href='adminIndex.php?panel=viewReservations&page=" . $page_number . "'> " . $buttontext . " </a>";
}

// End of Pagination Button Function =========================================================================
//============================================================================================================

//============================================================================================================
//Function to assign tables to an existing reservation button that passes GET variables to reservation form - Constantine 
//============================================================================================================

function reservationbutton($reservationID){
    return "<a href='adminIndex.php?panel=setReservationTables&reservationType=existing&reservationid=$reservationID' class='btn btn-info btn-xs' role='button'><strong>Assign Tables</strong></a>";
}

//End of Function to assign tables to an existing reservation button that passes GET variables to reservation form
//============================================================================================================


//============================================================================================================
//Function to cancel a reservation - Constantine =============================================================
//============================================================================================================

function cancBut($idinput) {
    return "<a href='../functions/adminActionsProccessing.php?source=reservations&action=cancelReservation&id=$idinput' class='btn btn-danger btn-xs' role='button'><strong>Cancel</strong></a>";
}

// End of Function to cancel a reservation ===================================================================
//============================================================================================================


//============================================================================================================
//Main query to get reservations - Constantine ===============================================================
//============================================================================================================

$sql = "SELECT 
BOOKING_ID, users.FIRSTNAME, users.LASTNAME, BOOKING_DATE, BOOKING_TIME, SMOKING_BOOL, BOOKING_SIZE, booking_status.B_STATUS_NAME, booking_status_B_STATUS_ID
FROM booking, users, booking_status 
WHERE users.USER_ID = booking.USERS_USER_ID AND
booking.booking_status_B_STATUS_ID = booking_status.B_STATUS_ID
ORDER BY
BOOKING_DATE DESC, BOOKING_TIME DESC LIMIT " . $pr . "," . $rowsperpage;
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table table-bordered' style='margin:0 !important;'><tr><thead><th>ID</th><th>First Name</th><th>Last Name</th><th>Date</th><th>Time</th><th>Smoking?</th><th>Persons</th><th>Status</th><th>Tables</th><th>Action</th></thead></tr>";
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $smokers = "no";
        if ($row['SMOKING_BOOL'] === 1) {
            $smokers = "yes";
        }
        echo "<tr><td>" . $row['BOOKING_ID'] . "</td><td>" . $row['FIRSTNAME'] . "</td><td>" . $row['LASTNAME'] . "</td><td>" . $row['BOOKING_DATE'] . "</td><td>" . $row['BOOKING_TIME'] . "</td><td>" . $smokers . "</td><td>" . $row['BOOKING_SIZE'] . "</td><td> " .  $row['B_STATUS_NAME'] . " </td><td>" . (($row['booking_status_B_STATUS_ID']=='1') ? reservationbutton($row['BOOKING_ID']) : '-') . "</td><td>" . (($row['booking_status_B_STATUS_ID']=='1') || ($row['booking_status_B_STATUS_ID']=='2') ?  cancBut($row['BOOKING_ID']) : '-') . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

//End of Main query to get Reservations ======================================================================
//============================================================================================================


//============================================================================================================
//Quering result pages number to utilize pagination button (when to show or hide) - Constantine ==============
//============================================================================================================

$sql_pagin = "SELECT 
BOOKING_ID, users.FIRSTNAME, users.LASTNAME, BOOKING_DATE, BOOKING_TIME, SMOKING_BOOL, BOOKING_SIZE, booking_status.B_STATUS_NAME FROM booking, users, booking_status 
WHERE users.USER_ID = booking.USERS_USER_ID AND
booking.booking_status_B_STATUS_ID = booking_status.B_STATUS_ID
ORDER BY
BOOKING_DATE DESC, BOOKING_TIME DESC"; //query to return pagination size
$result1 = $mysqli->query($sql_pagin);
$count_results = mysqli_num_rows($result1);
$check_pages_size = $pr + $rowsperpage;
$pagelimit = ceil($count_results / $rowsperpage); // Indicates the number of pages the query returned ceiled

//End of Quering result pages number to utilize pagination button (when to show or hide) - Constantine =======
//============================================================================================================

?>
<!------------------------------------------------------------------------------------------------------------
// Button to cancel old pending reservations - Constantine ---------------------------------------------------
-------------------------------------------------------------------------------------------------------------->

<br><a class='btn btn-warning' style='margin:5px;' href='../functions/adminActionsProccessing.php?source=reservations&action=cancelOldPendingReservations'>Cancel Old Pending Reservations</a><br>

<!--Button to cancel old pending reservations - Constantine ---------------------------------------------------
-------------------------------------------------------------------------------------------------------------->

<?php
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

//End of Paginations buttons creations through function and query  - Constantine =============================
//============================================================================================================


$mysqli->close(); //Closing Database connection
?>