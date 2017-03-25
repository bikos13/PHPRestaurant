<?php
include "./functions/dbcon.php";

//============================================================================================================
//Creating Pagination Variables - Constantine ================================================================
//============================================================================================================

$rowsperpage = 10; //Pagination Results per page that i want to view
$pageCleanInput = test_GET_page($_GET['page']); //Collecting page number from get and validating input
$pageMinusOne = $pageCleanInput - 1; // Subtracting 1 so when page is 1 the result will define as index 0 using the pr variable
$pr = $pageMinusOne * $rowsperpage; // Indicating SQL query index in LIMIT
$next_page = $pageCleanInput + 1; //Next page Button Variable
$prv_page = $pageCleanInput - 1; //Previous page Button Variable

//End of Creating Pagination Variables =======================================================================
//============================================================================================================



//============================================================================================================
//Function to create a pagination button inputs: target page number and button's text - Constantine ==========
//============================================================================================================

function pagBut($page_number, $buttontext) {
    echo "<a class='btn btn-default' style='margin:5px; !important' href='adminIndex.php?panel=manageTables&page=" . $page_number . "'> " . $buttontext . " </a>";
}

// End of Pagination Button Function =========================================================================
//============================================================================================================



//============================================================================================================
//Main query to get tables - Constantine =====================================================================
//============================================================================================================

$sql = "SELECT * FROM tables ORDER BY TABLE_CODE ASC LIMIT " . $pr . "," . $rowsperpage;
$result = $mysqli->query($sql);

//============================================================================================================
//Function to create a delete table button that passes GET variables to adminActionsProccessing.php - Constantine 
//============================================================================================================

function deleteButton($tableid){
    return "<a href='functions/adminActionsProccessing.php?source=tables&action=delete&id=$tableid' class='btn btn-danger btn-xs' role='button'><strong>Delete</strong></a>";
}

//Function to create a delete table button that passes GET variables to adminActionsProccessing.php ==========
//============================================================================================================

if ($result->num_rows > 0) {
    echo "<table class='table table-bordered' style='margin:0 !important;'><tr><thead><th>Table Name</th><th>Size</th><th>Smoking Area</th><th>Delete?</th></tr>";
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $smokers = "no";
        if ($row['SMOKING'] === 1) {
            $smokers = "yes";
        }
        echo "<tr><td>" . $row['TABLE_CODE'] . "</td><td>" . $row['TABLE_SIZE'] . "</td><td>" . $smokers . "</td><td>". deleteButton($row['TABLE_CODE']) ."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

//End of Main query to get tables ============================================================================
//============================================================================================================


//============================================================================================================
//Quering result pages number to utilize pagination button (when to show or hide) - Constantine ==============
//============================================================================================================

$sql_pagin = "SELECT * FROM tables ORDER BY TABLE_CODE ASC"; //query to return pagination size
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