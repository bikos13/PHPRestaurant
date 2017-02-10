    <!--Page Meta - Constantine -->
    <!--TITLE Constant is being used for the header <title> tag and also for the 'mobileTitle'  mobile version of class which echoes TITLE-->
    <?php define('TITLE', 'Profile'); ?>
    <!-- Page Meta - Constantine -->
    <?php include('includes/header.php'); ?>
    <?php if ((isset($_SESSION['loggedin'])) && ($_SESSION['loggedin'] = true)) { //Only for loggedin validation - Constantine ?>
    <div class="row">

        <div class="col-md-3" id='UserMenu'>
            <?php include 'memberIncludes/ProfileMenu.php'; //Including the usermenu from membersIncludes - Constantine ?> 
        </div>

        <div class="col-md-9"> <!-- Profile Main Area - Constantine -->
            <?php
            echo var_dump($_SESSION['loggedin']);
            echo '<pre>';
            echo var_dump($_SESSION['loggedin']);
            echo $_SESSION['userdata']['username'];
            echo '</pre>';
            ?>
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