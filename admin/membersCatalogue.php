
<?php
if (INPUT_GET) { //collects query from Admin Panel - Constantine
    $gotSearch = filter_input(INPUT_GET, 'userSearched');
    if ($gotSearch === '1') {
        $nameSearched = filter_input(INPUT_GET, 'nameSearched');
        echo $nameSearched;
        if (preg_match('/^[A-z]{3,}$/', $nameSearched)) {
            $sqlSupplementScript = " WHERE FIRSTNAME LIKE '$nameSearched%' OR LASTNAME LIKE '$nameSearched%' OR USERNAME LIKE '$nameSearched%'"; //this a part of searching query that it will be generated dynamically - Constantine
        }
    }
}
?>

<h4>New Reservation</a></h4>
<h4><small>Pick a customer for Reservation or <a href="adminIndex.php?panel=newUser">Create a new customer</a><br>Alternatively use the <a href="/adminIndex.php?panel=controlPanel">search box from Admin Panel</a> to find a specific customer</small></h4>
<div class="col-md-12">
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
    echo "<a class='btn btn-default reservation-button' style='margin:5px; !important' href='adminIndex.php?panel=members&page=" . $page_number . "'> " . $buttontext . " </a>";
}

// End of Pagination Button Function =========================================================================
//============================================================================================================



//============================================================================================================
//Function to create a reservation button that passes GET variables to reservation form - Constantine ========
//============================================================================================================

function reservationbutton($inputID, $inputEmail, $inputFname, $inputLname){
    return "<a href='adminIndex.php?panel=newReservation&userid=$inputID&email=$inputEmail&fname=$inputFname&lname=$inputLname&reservationType=new' class='btn btn-info btn-xs' role='button'><strong>Reservation</strong></a>";
}

//Function to create a reservation button that passes GET variables to reservation form ======================
//============================================================================================================



//============================================================================================================
//Main query to get users - Constantine ======================================================================
//============================================================================================================

$sql = "SELECT * FROM users" . (($gotSearch == '1') ?  $sqlSupplementScript : " ") . " ORDER BY FIRSTNAME ASC LIMIT " . $pr . "," . $rowsperpage;
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
                echo "<h4 class='panel-title'><small>#" . $row['USER_ID'] . " " . $row['FIRSTNAME'] . " " . $row['LASTNAME'] . "</small></h4>";
                echo "</div>"; //End of panel title - Constantine
                echo "<div class='panel-body'>";
                echo "<div class='col-md-12'>" . $row['USERNAME'] . "</div>";
                echo "<div class='col-md-12'>" . $row['CONTACT_NUMBER_1'] . " " . $row['CONTACT_NUMBER_2'] . "</div>";
                echo "<div class='col-md-12'>" . $row['EMAIL'] . "</div>";
                echo "</div>"; // End of panel body - Constantine
                echo "<div class='panel-footer'>";
                echo "<div class='row'>";
                echo "<div class='col-md-12'>" . reservationbutton($row['USER_ID'], $row['EMAIL'], $row['FIRSTNAME'], $row['LASTNAME']) . "</div>";
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
//if ($result->num_rows > 0) {

//    while ($row = $result->fetch_assoc()) {
//        $smokers = "no";
//        
//        $row['EMAIL'] . " . "</td><td> " . reservationbutton($row['USER_ID'], $row['EMAIL'], $row['FIRSTNAME'], $row['LASTNAME']) . " </td></tr>";
//    }
//    echo "</table>";
//} else {
//    echo "0 results";
//}

//End of Main query to get users =============================================================================
//============================================================================================================


//============================================================================================================
//Quering result pages number to utilize pagination button (when to show or hide) - Constantine ==============
//============================================================================================================

$sql_pagin = "SELECT * FROM users" . (($gotSearch == '1') ?  $sqlSupplementScript : " ") . " ORDER BY FIRSTNAME ASC"; //query to return pagination size
$result1 = $mysqli->query($sql_pagin);
$count_results = mysqli_num_rows($result1);
$check_pages_size = $pr + $rowsperpage;
$pagelimit = ceil($count_results / $rowsperpage); // Indicates the number of pages the query returned ceiled

//End of Quering result pages number to utilize pagination button (when to show or hide) - Constantine =======
//============================================================================================================
?></div><?php

if ($gotSearch == '1') { //Go back to search index page button if a query was requested
    echo "<div class='row'>";
    echo "<a class='btn btn-info' style='margin:5px;' href='/adminIndex.php?panel=controlPanel'>Back to search Index</a>";
    echo "</div>";
}


//============================================================================================================
//Paginations buttons creations through function and query  - Constantine ====================================
//============================================================================================================

if ($pageCleanInput > 1) {
    pagBut("1", "First Page");
    pagBut($prv_page, "Previous Page");
}
if ($count_results > $check_pages_size) {
    pagBut($next_page, "Next Page");
    pagBut($pagelimit, "Last Page");
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