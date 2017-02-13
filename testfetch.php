<?php
session_start();
include "./functions/dbcon.php";
include "./functions/validations.php";

if ($mysqli->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//Crating Pagination Variables - Constantine =======================
$rowsperpage = 3; //Pagination Results per page
$pageCleanInput = test_GET_page($_GET['page']); //Collecting page number from get
$pageMinusOne = $pageCleanInput;
$pageMinusOne = $pageMinusOne - 1;
$pr = $pageMinusOne * $rowsperpage;
$next_page = $pageCleanInput + 1; //Next page Button Variable
$prv_page = $pageCleanInput - 1; //Previous page Button Variable
//==================================================================

$sql = "SELECT BOOKING_ID, BOOKING_DATE, BOOKING_TIME, BOOKING_SIZE, SMOKING_BOOL FROM booking WHERE USERS_USER_ID =" . $_SESSION['userdata']['userid'] . " ORDER BY BOOKING_ID DESC LIMIT " .$pr. "," .$rowsperpage;
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='table-responsive'><table class='table-bordered'><tr><th>Booking_ID</th><th>Date</th><th>Time</th><th>Table Size</th><th>Smoking area</th></tr>";
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $smokers = "no";
        if ($row["SMOKING_BOOL"]=="1") {
            $smokers = "yes";
        }

        echo "<tr><td>" . $row["BOOKING_ID"] . "</td><td>" . $row["BOOKING_DATE"] . "</td><td>" . $row["BOOKING_TIME"] . "</td><td>" . $row["BOOKING_SIZE"] . "</td><td>" . $smokers . "</td></tr>";
    }
    echo "</table></div>";
} else {
    echo "0 results";
}

//Creating Dynamic Pagination Buttons  - Constantine =========================================================
$sql_pagin = "SELECT BOOKING_ID, BOOKING_DATE, BOOKING_TIME, BOOKING_SIZE, SMOKING_BOOL FROM booking WHERE USERS_USER_ID =" . $_SESSION['userdata']['userid'];
$result1 = $mysqli->query($sql_pagin);
$count_results = mysqli_num_rows($result1);
$check_pages_size = $pageCleanInput + $rowsperpage;

if($count_results > $check_pages_size) {
echo "<a href='testfetch.php?page=".$next_page."'>Next</a><br>";
}
$mysqli->close(); //Closing Database connection

if ($prv_page > 0) {
    echo "<a href='testfetch.php?page=".$prv_page."'>Previous</a>";
}
//============================================================================================================
?>