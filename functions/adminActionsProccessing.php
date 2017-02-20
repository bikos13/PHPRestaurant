<h1>Proccessing Information</h1>
<?php
// Starting Session - Constantine
session_start();
//Including Database Connection function - Constantine
include "dbcon.php";

//Including validation.php functions - Constantine
include "validations.php";

$source = filter_input(INPUT_GET, 'source'); // This variable holds the source page that wants to use the action proccessing page - Constantine
$action = filter_input(INPUT_GET, 'action'); // This variable holds the main action to be used - Constantine
$id = filter_input(INPUT_GET, 'id'); // This variable holds the id will be used for manipulation - Constantine
//======================================================================================
// Filtering the source to use the appropriate functions and operations - Constantine ==
//======================================================================================


If ($source != null) { // Checking if the source is valid
    switch ($source):




//======================================================================================
// Tables Case and Actions - Constantine ===============================================
//======================================================================================
        case('tables'):
            $id = strtoupper($id); // Capitalizing input - Constantine

            switch ($action):

                case('add'):
                    $tablesize = filter_input(INPUT_GET, 'size');
                    $smoking = filter_input(INPUT_GET, 'smoking');
                    if (($tablesize != null) && ($smoking != null)) {
                        echo "$id $tablesize $smoking";
                        $sql = "INSERT INTO `tables`(`TABLE_CODE`, `TABLE_SIZE`, `SMOKING`) VALUES ('$id','$tablesize','$smoking')";
                        $mysqli->query($sql);
                        if ($mysqli->connect_errno) {
                            die("Insert into tables failed: %s\n" . $mysqli->connect_error);
                            exit();
                        }

                        $mysqli->close();
                        $_SESSION['successmessage'] = "The table $id has been successfully added";
                        header('Location: ../adminIndex.php?panel=manageTables&page=1');
                    } else {
                        $mysqli->close();
                        $_SESSION['warnings'] = "No table with this id has been found";
                        header('Location: ../adminIndex.php?panel=manageTables&page=1');
                        die('Invalid table inputs');
                    }
                    break;

                case('delete'):
                    $sql = "SELECT * FROM tables WHERE TABLE_CODE = '$id'";
                    $result = $mysqli->query($sql);

                    if ($result->num_rows == 1) {

                        $sql1 = "DELETE FROM tables WHERE TABLE_CODE = '$id'";
                        $mysqli->query($sql1);
                        $mysqli->close();
                        $_SESSION['successmessage'] = "The table $id has been successfully deleted";
                        header('Location: ../adminIndex.php?panel=manageTables&page=1');
                    } else {
                        $mysqli->close();
                        $_SESSION['warnings'] = "No table with this id has been found";
                        header('Location: ../adminIndex.php?panel=manageTables&page=1');
                        die('No table with this id has been found');
                    }
                    break;

                default :
                    $_SESSION['warnings'] = "Wrong input detected";
                    header('Location: ../adminIndex.php?panel=manageTables&page=1');
                    break;
            endswitch;

// End of Tables Case and actions ======================================================
//======================================================================================

            break;

    endswitch; // End of $source switch
} else {
    die('No source has been detected!');
}


// End of Filtering the source to use the appropriate functions - Constantine ==========
//======================================================================================
?>