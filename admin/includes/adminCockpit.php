<?php include 'functions/fetchReservations.php'; ?>
<h4><small>View or Create Reservations</small></h4>
<div class="col-sm-4" style="padding:20px;"><a href="/adminIndex.php?panel=viewReservations&page=1&firstNameOrLastNameSearched=&dateSearched=&statusSearched=1&bookingSearched=1" class="btn btn-warning btn-lg"><strong style="text-shadow:2px 2px 5px black;"><span style=" font-size:1.25em;"><?php echo $pendingReservations ?></span><br>Pending<br>Reservations </strong></a></div>
<div class="col-sm-4" style="padding:20px;"><a href="/adminIndex.php?panel=viewReservations&page=1&firstNameOrLastNameSearched=&dateSearched=<?php echo $today ?>&statusSearched=2&bookingSearched=1" class="btn btn-info btn-lg"><strong style="text-shadow:2px 2px 5px black;"> Today's<br><span style=" font-size:1.25em;"><?php echo $todaysReservations ?></span><br>Reservations </strong></a></div>
<div class="col-sm-4" style="padding:20px;"><a href="/adminIndex.php?panel=members&page=1" class="btn btn-success btn-lg"><strong style="text-shadow:2px 2px 5px black;"> Create<br>A<br>reservation </strong></a></div>