<h4>Admin Panel</h4>

<div class="row"> <!-- Search box - Constantine -->
    <div class="box">
         <h5>Search Reservations</h5>
         <form class="form-group" method="GET">
        <input type="hidden" name="panel" value="viewReservations">
        <input type="hidden" name="page" value="1">
        <div class="col-md-4">Name or Surname: <input class="form-control form-inline" type="text" name="firstNameOrLastNameSearched" placeholder="At least three letters"></div>
        <div class="col-md-4">Date: <input class="form-control form-inline" type="date" name="dateSearched"></div>
        <div class="col-md-4">Reservation Status<select name="statusSearched" class="form-control form-inline">
            <option value="default" selected>All</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            </select></div>
        <div class="col-md-4 col-md-offset-4" style="padding: 20px 0px;"><button type="submit" name="bookingSearched" value="1" class="btn btn-info">Search</button></div>
        
        
    </form>
</div>
</div> <!-- End of Search box -->

