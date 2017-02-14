<!--Page Meta - Constantine -->
<!--TITLE Constant is being used for the header <title> tag and also for the 'mobileTitle'  mobile version of class which echoes TITLE-->
<?php define('TITLE', 'Profile'); ?>
<!-- Page Meta - Constantine -->
<?php include('includes/header.php'); ?>

<?php if ((isset($_SESSION['loggedin'])) && ($_SESSION['loggedin'] = true)) { //Only for loggedin validation - Constantine ?>
    <div class="row">

        <?php
        if (isset($_SESSION['reservationmessage'])) { // View passed success messages - Constantine ?>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-success"><?php echo $_SESSION['reservationmessage']; ?></div>
                </div>
            </div>
            <?php
            unset($_SESSION['reservationmessage']);
        }
        
        include 'membersArea/includes/ProfileMenu.php'; //Including the usermenu from membersIncludes - Constantine
        include 'functions/validations.php'; //including validation functions - Constantine
        ?> 

        

        <div class="col-md-9"> <!-- Profile Main Area - Constantine -->
            <div class="box">
                <?php
                switch (test_input($_GET['panel'])):
                    case "home":
                        include 'membersArea/membersHome.php';
                        break;
                    case "newReservation":
                        include 'membersArea/makeAReservation.php';
                        break;
                    case "viewReservations":
                        include 'membersArea/reservationsHistory.php';
                        break;
                endswitch;
                ?>
            </div>
        </div>
    </div>
    </div>

    <?php include('includes/footer.php'); ?>

    </body>

    </html>
    <?php
} else { //If not loggedin redirect to login page with message
    $_SESSION['warnings'] = "You have to be logged in to access the profile page";
    header("Location: login.php");
}
?>