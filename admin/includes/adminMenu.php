<!--This file includes the div that shows the admin menu on the left side of the admin panel - Constantine -->

<div class="col-md-3" id='UserMenu'>

    <div class="box">
        <div class="row">
        <div class="col-md-12">
        <h4>Hello, <?php echo $_SESSION['userdata']['firstname']; ?></h4><br>

        <div class="dropdown">

            <button class="btn btn-primary dropdown-toggle profilebtn" type="button" data-toggle="dropdown"> Administrator Menu <span class="caret"></span></button>
            <ul class="dropdown-menu">
                
                <?php // Calling the admin $navMenuItems from the arrays.php which is included in headerAdmin.php - Constantine

                foreach ($adminMenuItems as $item) {
                    echo "<li><a href='" . $item['slug'] . "' > " . $item['title'] . " </a></li>";
                }
                
                ?>
                
            </ul>
        </div>

        <h4><?php echo date('l,  d m Y') ?></h4><br>
        </div>
        <div class="col-md-12">
            <?php include 'functions/fetchReservations.php'; ?>
            <div class="col-sm-12"><a href="/adminIndex.php?panel=viewReservations&page=1&firstNameOrLastNameSearched=&dateSearched=&statusSearched=1&bookingSearched=1" class="text-warning">You have <?php echo $pendingReservations ?> Pending Reservations </a></div><br><br><br>
            <div class="col-sm-12"><a href="/adminIndex.php?panel=viewReservations&page=1&firstNameOrLastNameSearched=&dateSearched=<?php echo $today ?>&statusSearched=2&bookingSearched=1" class="text-info"> View Today's <?php echo $todaysReservations ?> Reservations </a></div>
        </div>
    </div>
    </div>


</div>