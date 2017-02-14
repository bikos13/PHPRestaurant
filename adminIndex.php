<?php define('TITLE', 'Admin Panel'); ?>
<!-- Page Meta - Constantine -->
<?php include('./functions/validations.php'); // including validations.php file ?>
<?php include('admin/includes/headerAdmin.php'); ?>
<?php include('admin/includes/adminMenu.php'); // including admin's left panel menu ?>


<div class="col-md-9">
    <div class="box">
        <?php
        switch (test_input($_GET['panel'])):
            case "controlPanel":
                include 'admin/adminControlPanel.php';
                break;
            case "controlPanel":
                include 'admin/adminControlPanel.php';
                break;
            case "controlPanel":
                include 'admin/adminControlPanel.php';
                break;
            case "controlPanel":
                include 'admin/adminControlPanel.php';
                break;
            case "controlPanel":
                include 'admin/adminControlPanel.php';
                break;
            case "controlPanel":
                include 'admin/adminControlPanel.php';
                break;
            case "controlPanel":
                include 'admin/adminControlPanel.php';
                break;

        endswitch;
        ?>
    </div>
</div>

<?php include('admin/includes/footerAdmin.php'); ?>
</body>

</html>
