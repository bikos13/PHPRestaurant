<?php
///===================================================
// Fetching assigned tables - Constantine ===========
//===================================================

function collectAssignedTables($inputarray) {

    $i = 1; //counter
    foreach ($inputarray as $keyname => $keyvalue) {
        if (preg_match('/^tableSelected[a-zA-Z][1-9]$/', $keyname) == TRUE) {
            $outputarray[$i] = $keyvalue;
            $i++;
        }
    }
    return $outputarray;
}

// End of Fetching assigned tables - ================
//===================================================

?>