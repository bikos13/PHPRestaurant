<!--
===========================================================================
Description - Constantine
This panel is used when the users doesn't have any future reservations
===========================================================================
-->

<div class="col-md-12">
   <?php
    $today = date('l');
    switch ($today):
        case "Monday":
            echo "Every <strong>Monday</strong> It feels hard to be on the start of the week and being hungry after the first day at work.. <br><br> How about relaxing at our perfect dining tables with your friends?";
            break;
        case "Tuesday":
            echo "We know the <strong>Tuesdays</strong>  are the toughest days cause of Mondays rough start and the way to go for the rest of the week <br><br> How about a burger?";
            break;
        case "Wednesday":
            echo "Finally <strong>Wednesday</strong> we are in the middle of the week! <br><br> How about checking at Felipetakia with your friends?";
            break;
        case "Thursday":
            echo "<strong>Thursdays</strong> are great for booze and food, aren't they? <br><br> Grab a table and enjoy your night with us";
            break;
        case "Friday":
            echo "It's <strong>FRI FRI FRIDAY</strong> baby! The perfect day to take your co-workers <br><br> for an outstanding dinner at Felipetakia!";
            break;
        case "Saturday":
            echo "<strong>Saturdays</strong> are Precious for couples! <br><br> Bring your dove and offer her a Fillet Minion and leave the rest to us!";
            break;
        case "Sunday":
            echo "Oh No! It's <strong>Sunday</strong>. Another week is coming tomorrow! Buckle up <br><br> and serve yourself a great meal in advance!";
            break;
    endswitch;
    ?>
</div><br><br><br><br>
<div class="col-md-6">
    <a href="profile.php?panel=newReservation"><button class="btn btn-lg profilebtn"><span class="glyphicon glyphicon-glass"></span><br>Make a reservation</button></a>
</div>
<div class="col-md-6">
    <a href="profile.php?panel=viewReservations&page=1"><button class="btn btn-lg profilebtn"><span class="glyphicon glyphicon-book"></span><br>View Reservations History</button></a>
</div>
