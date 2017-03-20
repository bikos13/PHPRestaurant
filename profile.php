<!--Page Meta - Constantine -->
<!--TITLE Constant is being used for the header <title> tag and also for the 'mobileTitle'  mobile version of class which echoes TITLE-->
<?php define('TITLE', 'Profile'); ?>
<!-- Page Meta - Constantine -->
<?php include('includes/header.php'); ?>

<?php if ((isset($_SESSION['loggedin'])) && ($_SESSION['loggedin'] = true)) { //Only for loggedin validation - Constantine ?>
    <div class="row">

        <?php
        if (isset($_SESSION['successmessage'])) { // View passed success messages - Constantine ?>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-success"><?php echo $_SESSION['successmessage']; ?></div>
                </div>
            </div>
            <?php
            unset($_SESSION['successmessage']);
        }
        

        if (isset($_SESSION['warnings'])) { // View passed Warning messages - Constantine ?>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-danger"><?php echo $_SESSION['warnings']; ?></div>
                </div>
            </div>
            <?php
            unset($_SESSION['warnings']);
        }

        
        include 'membersArea/includes/ProfileMenu.php'; //Including the usermenu from membersIncludes - Constantine
        include 'functions/validations.php'; //including validation functions - Constantine
        ?> 

        

        <div class="col-md-9"> <!-- Profile Main Area - Constantine -->
        
            
            <div class="row">
                <div class="box">
                <?php
                
                $panelChoice = filter_input(INPUT_GET, 'panel'); // Filtering GET - Constantine
                        
                if (isset($panelChoice)) { // If GET panel is iset - Constantine
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
                }
                else { //in case of invalid GET panel variable - Constantine
                    include 'membersArea/membersHome.php';
                }
                ?>
            </div> <!-- End of row -->
            </div> <!-- End of box -->
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