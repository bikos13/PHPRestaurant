<?php
include "./functions/dbcon.php";


if (INPUT_GET) { //collects query from Admin Panel - Constantine

    
    $gotSearch = filter_input(INPUT_GET, 'bookingSearched');
    if ($gotSearch == '1') {
        $sqlSupplementScript = ""; //this a part of searching query that it will be generated dynamically - Constantine
        $nameSearched = filter_input(INPUT_GET, 'firstNameOrLastNameSearched');
        $dateSearched = filter_input(INPUT_GET, 'dateSearched');
        $statusSearched = filter_input(INPUT_GET, 'statusSearched');
        if (preg_match('/^[A-z]{3,}$/', $nameSearched)) {
            $sqlSupplementScript .= "AND (FIRSTNAME LIKE '$nameSearched%' OR LASTNAME LIKE '$nameSearched%') ";
        }
        if (preg_match('/^[2][0][0-9][0-9][\-][0-1][0-9][\-][0-3][0-9]$/', $dateSearched)) {
            $sqlSupplementScript .= "AND BOOKING_DATE ='$dateSearched' ";
        }
        if ($statusSearched !== 'default') {
            $sqlSupplementScript .= "AND booking_status_B_STATUS_ID ='$statusSearched' ";
        }

    }
}
    ?>

    <h4>View Reservations</h4>
    <div class="row">
        <div class="box">
        <div class="col-md-12"><h4><small>Buttons Usage</small></h4></div>
        
        <div class="col-md-3"><span class="glyphicon glyphicon-minus" style="color:red;"></span> = Cancel Reservation</div>
        <div class="col-md-3"><span class="glyphicon glyphicon-remove" style="color:red;"></span> = Delete Reservation</div>
        <div class="col-md-3"><span class="glyphicon glyphicon-thumbs-down" style="color:red;"></span> = Customer <strong>did not</strong> attend</div>
        <div class="col-md-3"><span class="glyphicon glyphicon-thumbs-up" style="color:green;"></span> = Customer <strong>did</strong> attend</div>
        
        </div>
    </div>


    <?php

//============================================================================================================
// Fetch Assigned Tables from each Approved booking query  - Constantine =====================================
//============================================================================================================

    function fetchAssignedTables($apprReservationID) {
        include "./functions/dbcon.php";
        $tablesfetched = " "; // String that will get concatenated values of tables - Constantine
        $sqlFetchAssigned = "SELECT * FROM `tables_booked` WHERE `Booking_BOOKING_ID` = '$apprReservationID'";
        $resultTablesAssigned = $mysqli->query($sqlFetchAssigned);
        if ($resultTablesAssigned->num_rows > 0) {
            while ($row = $resultTablesAssigned->fetch_assoc()) {
                $tablesfetched .= $row['TABLES_TABLE_CODE'] . " ";
            }
        } else {
            $tablesfetched = "Error";
        }
        return $tablesfetched;
    }

// End of Fetch Assigned Tables from each Approved booking query  - Constantine ==============================
//============================================================================================================
//
//
//
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
//
//
//
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

    function assignTables($reservationID) {
        return "<a href='adminIndex.php?panel=setReservationTables&reservationType=existing&reservationid=$reservationID' class='btn btn-info btn-xs' role='button'><strong>Assign Tables</strong></a>";
    }

//End of Function to assign tables to an existing reservation button that passes GET variables to reservation form
//============================================================================================================
//
//
//
//============================================================================================================
//Function to create a reservation cancel button - Constantine ===============================================
//============================================================================================================

    function cancBut($idinput) {
        return "<a href='../functions/adminActionsProccessing.php?source=reservations&action=changeStatus&id=$idinput&newStatus=3&messageStatus=cancelled'  title='Cancel Reservation'><strong><span class='glyphicon glyphicon-minus' style='color:red;'></span></strong></a>";
    }

// End of Function to create a reservation cancel button =====================================================
//============================================================================================================
//
//
//
//=============================================================================================================
//Function to create a reservation deletion button - Constantine ==============================================
//=============================================================================================================

    function delBut($idinput) {
        return "<a href='../functions/adminActionsProccessing.php?source=reservations&action=changeStatus&id=$idinput&newStatus=6&messageStatus=deleted' title='Delete Reservation'><span class='glyphicon glyphicon-remove' style='color:red;'></span></a>";
    }

// End of Function to create a reservation deletion button ====================================================
//=============================================================================================================
//
//
//
//=============================================================================================================
//Function to create a reservation unattendance button - Constantine ==========================================
//=============================================================================================================

    function unattendBut($idinput) {
        return "<a href='../functions/adminActionsProccessing.php?source=reservations&action=changeStatus&id=$idinput&newStatus=4&messageStatus=unattended' title='Unattended Reservation'><span class='glyphicon glyphicon-thumbs-down' style='color:red;'></span></a>";
    }

// End of Function to create a unattendance deletion button ===================================================
//=============================================================================================================
//
//
//
//=============================================================================================================
//Function to create a reservation attendance button - Constantine ==========================================
//=============================================================================================================

    function attendBut($idinput) {
        return "<a href='../functions/adminActionsProccessing.php?source=reservations&action=changeStatus&id=$idinput&newStatus=5&messageStatus=attended' title='Attended Reservation'><span class='glyphicon glyphicon-thumbs-up' style='color:green;'></span></a>";
    }

// End of Function to create a attendance deletion button ===================================================
//=============================================================================================================
//
//
//============================================================================================================
//Main query to get reservations - Constantine ===============================================================
//============================================================================================================

    $sql = "SELECT 
BOOKING_ID, users.FIRSTNAME, users.LASTNAME, BOOKING_DATE, BOOKING_TIME, SMOKING_BOOL, BOOKING_SIZE, booking_status.B_STATUS_NAME, booking_status_B_STATUS_ID
FROM booking, users, booking_status 
WHERE users.USER_ID = booking.USERS_USER_ID AND
booking.booking_status_B_STATUS_ID = booking_status.B_STATUS_ID " .
(($gotSearch == '1') ? $sqlSupplementScript : " ") .
" ORDER BY
BOOKING_DATE DESC, BOOKING_TIME DESC LIMIT " . $pr . "," . $rowsperpage;
    

    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class ='table-responsive'>";
        echo "<table class='table table-bordered' style='margin:0 !important;'><tr><thead><th>ID</th><th>First Name</th><th>Last Name</th><th>Date</th><th>Time</th><th>Smoking?</th><th>Persons</th><th>Status</th><th>Tables</th><th>Action</th></thead></tr>";
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $smokers = "no";
            if ($row['booking_status_B_STATUS_ID'] !== '6') {

                if ($row['SMOKING_BOOL'] === '1') {

                    $smokers = "<strong>yes</strong>";
                }
                echo
                "<tr><td>"
                . $row['BOOKING_ID'] . "</td><td>"
                . $row['FIRSTNAME'] . "</td><td>"
                . $row['LASTNAME'] . "</td><td>"
                . $row['BOOKING_DATE'] . "</td><td>"
                . $row['BOOKING_TIME'] . "</td><td>"
                . $smokers . "</td><td>"
                . $row['BOOKING_SIZE'] . "</td><td> "
                . $row['B_STATUS_NAME'] . " </td><td>"
                . (($row['booking_status_B_STATUS_ID'] !== '3') ? (($row['booking_status_B_STATUS_ID'] == '1') ? assignTables($row['BOOKING_ID']) : fetchAssignedTables($row['BOOKING_ID'])) : '-' ) . "</td><td>"
                . (($row['booking_status_B_STATUS_ID'] == '1') || ($row['booking_status_B_STATUS_ID'] == '2') ? cancBut($row['BOOKING_ID']) . " " . delBut($row['BOOKING_ID']) . " " . unattendBut($row['BOOKING_ID']) . " " . attendBut($row['BOOKING_ID']) : '-') . "</td></tr>";
            }
        }
        echo "</table></div>";
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
booking.booking_status_B_STATUS_ID = booking_status.B_STATUS_ID " .
(($gotSearch == '1') ? $sqlSupplementScript : " ") .
" ORDER BY
BOOKING_DATE DESC, BOOKING_TIME DESC"; //query to return pagination size
    $result1 = $mysqli->query($sql_pagin);
    $count_results = mysqli_num_rows($result1);
    $check_pages_size = $pr + $rowsperpage;
    $pagelimit = ceil($count_results / $rowsperpage); // Indicates the number of pages the query returned ceiled
//End of Quering result pages number to utilize pagination button (when to show or hide) - Constantine =======
//============================================================================================================
    
    if ($gotSearch == '1') { //Go back to search index page button if a query was requested
        echo "<div class='row'>";
        echo "<a class='btn btn-info' style='margin:5px;' href='/adminIndex.php?panel=controlPanel'>Back to search Index</a>";
        echo "</div>";
    }
    
    ?>
    
    <!------------------------------------------------------------------------------------------------------------
    // Button to cancel old pending reservations - Constantine ---------------------------------------------------
    -------------------------------------------------------------------------------------------------------------->

    <br><a class='btn btn-danger' style='margin:5px;' href='../functions/adminActionsProccessing.php?source=reservations&action=cancelOldPendingReservations'>Delete Old Pending Reservations</a><br>

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