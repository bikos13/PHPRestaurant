<h4>New Reservation</a></h4>
<h4><small>Pick a customer for Reservation or <a href="adminIndex.php?panel=newCustomer">Create a new customer</a></small></h4>
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
    echo "<a class='btn btn-default' style='margin:5px; !important' href='profile.php?panel=members&page=" . $page_number . "'> " . $buttontext . " </a>";
}

// End of Pagination Button Function =========================================================================
//============================================================================================================



//============================================================================================================
//Function to create a reservation button that passes GET variables to reservation form - Constantine ========
//============================================================================================================

function reservationbutton($inputID, $inputEmail, $inputFname, $inputLname){
    return "<a href='adminIndex.php?panel=newReservation&userid=$inputID&email=$inputEmail&fname=$inputFname&lname=$inputLname' class='btn btn-info btn-xs' role='button'><strong>Reservation</strong></a>";
}

//Function to create a reservation button that passes GET variables to reservation form ======================
//============================================================================================================



//============================================================================================================
//Main query to get users - Constantine ======================================================================
//============================================================================================================

$sql = "SELECT USER_ID, FIRSTNAME, LASTNAME, USERNAME, EMAIL, CONTACT_NUMBER_1, CONTACT_NUMBER_2 FROM users ORDER BY FIRSTNAME ASC LIMIT " . $pr . "," . $rowsperpage;
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table table-bordered' style='margin:0 !important;'><tr><thead><th>ID</th><th>First Name</th><th>Last Name</th><th>Username</th><th>E-mail</th><th>1st Contact No</th><th>2nd Contact No</th><th>Reservation</th></thead></tr>";
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $smokers = "no";
        
        echo "<tr><td>" . $row['USER_ID'] . "</td><td>" . $row['FIRSTNAME'] . "</td><td>" . $row['LASTNAME'] . "</td><td>" . $row['USERNAME'] . "</td><td>" . $row['EMAIL'] . "</td><td>" . $row['CONTACT_NUMBER_1'] . "</td><td>" . $row['CONTACT_NUMBER_2'] . "</td><td> " . reservationbutton($row['USER_ID'], $row['EMAIL'], $row['FIRSTNAME'], $row['LASTNAME']) . " </td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

//End of Main query to get users =============================================================================
//============================================================================================================


//============================================================================================================
//Quering result pages number to utilize pagination button (when to show or hide) - Constantine ==============
//============================================================================================================

$sql_pagin = "SELECT USER_ID, FIRSTNAME, LASTNAME, USERNAME, EMAIL, CONTACT_NUMBER_1, CONTACT_NUMBER_2 FROM users ORDER BY FIRSTNAME ASC"; //query to return pagination size
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

$mysqli->close(); //Closing Database connection

//End of Paginations buttons creations through function and query  - Constantine =============================
//============================================================================================================
?>