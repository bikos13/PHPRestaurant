 <!-- Reservations Search box - Constantine -->
 <hr>
 <h4>Search</h4>  <hr>   
    <div class="col-md-6">
            <h5>Search Reservations</h5>
            <form class="form-group" method="GET">
                <input type="hidden" name="panel" value="viewReservations">
                <input type="hidden" name="page" value="1">
                <div class="col-md-12">Name or Surname: <input class="form-control form-inline" type="text" name="firstNameOrLastNameSearched" placeholder="At least three letters"></div>
                <div class="col-md-12">Date: <input id="datepicker" class="form-control form-inline" type="text" name="dateSearched"></div>
                <div class="col-md-12">Reservation Status<select name="statusSearched" class="form-control form-inline">
                        <option value="default" selected>All</option>
                        <?php
                        include "./functions/dbcon.php";
                        $sql = "SELECT `B_STATUS_ID`,`B_STATUS_NAME` FROM `booking_status`"; // Collect booking_statuses options from database - Constantine
                        $result = $mysqli->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                if (($row['B_STATUS_ID'] !== '6') && ($row['B_STATUS_ID'] !== '3'))  {
                                    echo "<option value=" . $row['B_STATUS_ID'] . ">" . $row['B_STATUS_NAME'] . "</option>";
                                }
                            }
                        }
                        $mysqli->close();
                        ?>
                    </select>
                </div>
                <div class="col-md-4 col-md-offset-4" style="padding: 20px 0px;"><button type="submit" name="bookingSearched" value="1" class="btn btn-info">Search Reservation</button></div>


            </form>
            </div> <!-- End of Reservations column -->
    
    
    

        <div class="col-md-6">
            <h5>Search Users</h5>
            <form class="form-group" method="GET">
                <input type="hidden" name="panel" value="members">
                <input type="hidden" name="page" value="1">
                <div class="col-md-12">Name, Surname, Username, E-mail: <input class="form-control form-inline" type="text" name="nameSearched" placeholder="At least three letters"></div>
                <div class="col-md-4 col-md-offset-4" style="padding: 20px 0px;"><button type="submit" name="userSearched" value="1" class="btn btn-info">Search User</button></div>


            </form>
        </div> <!-- End of Reservations Search box -->
        
        <script>
  $( function() {
    $( "#datepicker" ).datepicker({
    currentText: "Now",
    dateFormat: "dd-mm-yy",
    minDate: 0,
    defaultDate: 0
    }); 
} );
  </script>
