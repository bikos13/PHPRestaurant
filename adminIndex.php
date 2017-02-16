<?php define('TITLE', 'Admin Panel'); ?>
<!-- Page Meta - Constantine -->
<?php include('admin/includes/headerAdmin.php'); ?>
<?php 
if ((isset($_SESSION['loggedin'])) && ($_SESSION['loggedin'] == true)) { // Check if the user is logged in
    if ($_SESSION['userdata']['isadmin'] == 1) { //Only for admin validation - Constantine ?>

<?php include('./functions/validations.php'); // including validations.php file ?>

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
        } ?>

<?php include('admin/includes/adminMenu.php'); // including admin's left panel menu ?>

    <div class="col-md-9">
        <div class="box">
            
            <?php
            
            $panelOption = filter_input(INPUT_GET, 'panel'); //filter get option and act based on switch - Constantine
                            
            switch ($panelOption):
                case "controlPanel":
                    include 'admin/adminControlPanel.php';
                    break;
                case "members":
                    include 'admin/membersCatalogue.php';
                    break;
                case (preg_match('/newReservation.*/', $panelOption) ? true : false): // Validates input along with get parameters
                    include 'admin/createReservation.php';
                    break;
                case "newCustomer":
                    include 'admin/newCustomer.php';
                    break;
                case "controlPanel":
                    include 'admin/adminControlPanel.php';
                    break;
                case "controlPanel":
                    include 'admin/adminControlPanel.php';
                    break;
                case "setStoreHours":
                    include 'admin/setStoreHours.php';
                    break;
                default :
                    include 'admin/adminControlPanel.php'; //If GET variable is not set include the default tile
                    break;
            endswitch;
            

            ?>
        </div>
    </div>

    <?php include('admin/includes/footerAdmin.php'); ?>
    </body>

    </html>

    <?php
    }
    else {
        $_SESSION['warnings'] = "Access Denied to non-authorized area";
    header("Location: profile.php?panel=home");
    }

} else
    
    { //If not loggedin
    $_SESSION['warnings'] = "Access Denied";
    header("Location: login.php");
    
} 
?>