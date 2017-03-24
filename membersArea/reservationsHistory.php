<h3 class="hidden-sm hidden-xs">Reservations History</h3>
<!-- Reservations Main Area - Constantine -->
<?php
include "./functions/dbcon.php";

//============================================================================================================
//Creating Pagination Variables - Constantine ================================================================
//============================================================================================================

$rowsperpage = 9; //Pagination Results per page that i want to view
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

$sql = "SELECT * FROM booking, booking_status WHERE USERS_USER_ID = " . $_SESSION['userdata']['userid'] . " AND booking.booking_status_B_STATUS_ID = booking_status.B_STATUS_ID ORDER BY BOOKING_ID DESC LIMIT " . $pr . "," . $rowsperpage;
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {

            $counteri = 1; //Counter for collapsible records
            // output data of each row
            while ($row = $result->fetch_assoc()) {

                $isItRow = ($counteri % 3); // Dynamically create rows based on isItRow
                if ($isItRow === 1) {
                    echo "<div class='row'>"; // Create a row div if it's the first record
                }
                echo "<div id='panel#$counteri' class='col-md-4 order-panel'>";
                echo "<div class='panel-group' style='border: solid 1px grey; border-radius: 5px;'>";
                echo "<div class='panel panel-default'>";
                echo "<h4 class='panel-title'>#" . $row["BOOKING_ID"] . " " . $row["BOOKING_DATE"] . "</h4>";
                echo "</div>"; //End of panel title - Constantine
                echo "<div class='panel-body'>";
                echo "<div class='col-md-12'>" . $row["BOOKING_TIME"] . "</div>";
                echo "<div class='col-md-12'> Person(s): " . $row["BOOKING_SIZE"] . "</div>";
                echo "<div class='col-md-12'>" . (($row['SMOKING_BOOL'] === '1') ? "Smoking" : "<strong>Non</strong>-Smoking") . "</div>";
                echo "</div>"; // End of panel body - Constantine
                echo "<div class='panel-footer'>";
                echo "<div class='row'>";
                echo "<div class='col-md-12'>" . $row["B_STATUS_NAME"] . "</div>";
                echo "</div><div class='row'>";
                echo "</div></div></div></div>";
                if ($isItRow === 0) {
                    echo "</div>"; // // End a row div if it's the forth record
                }
                $counteri++;
            }
        } else {
            echo "0 results";
        }

//============================================================================================================
//Quering result pages number to utilize pagination button (when to show or hide) - Constantine ==============
//============================================================================================================

$sql_pagin = "SELECT * FROM booking, booking_status WHERE USERS_USER_ID = " . $_SESSION['userdata']['userid'] . " AND booking.booking_status_B_STATUS_ID = booking_status.B_STATUS_ID ORDER BY BOOKING_ID"; //query to return pagination size
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

<script>
    $(function () {

        $(".panel-group").mouseenter(function () {
            $(this).css("border", "3px solid grey");
        });

        $(".panel-group").mouseleave(function () {
            $(this).css("border", "1px solid grey");
        });

    });

</script>
