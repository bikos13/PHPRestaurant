<html>
    <?php
    session_start();
    include "./functions/dbcon.php";
    include "./functions/validations.php";
    include "includes/phpstorehours.php";

//==========================================================================
// Quering store hours from database and updating values - Constantine =====
// =========================================================================
    include "./functions/dbcon.php";
    $sql = "SELECT DAY_NAME, OPENING_HOUR, CLOSING_HOUR FROM storehours";
    $result = $mysqli->query($sql);



    if ($result->num_rows > 0) {
        $i = 1;

    while ($row = $result->fetch_assoc())  {
            
            $openhour = $row['OPENING_HOUR'];
            $closinghour = $row['CLOSING_HOUR'];
            $hoursConcat = $openhour."-".$closinghour;
            $hours[$row['DAY_NAME']] = $hoursConcat;
            
            $i++;
        }
    }
            echo var_dump($hours);

    $mysqli->close();
// End of Quering store hours from database and updating values ============
// ========================================================================= 
    ?>
</html>