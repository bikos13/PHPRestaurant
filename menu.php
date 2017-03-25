<?php 
include('functions/init.php');
define('TITLE', 'Our menu'); //title being used for mobile view and browser title
include('includes/header.php');
?>


<!-- Including getMenuFromCategory() Function - Constantine -->
<?php include_once "./functions/foodCataloging.php"; ?>
<!-- !Including getMenuFromCategory() Function - Constantine -->

<!--  Category Title - Constantine -->
<div class="row">
    <div class="box">
     <h2>Salad Ballads</h2>
    </div>
</div>
<!--  !Category Title - Constantine -->

<div class="row">
<?php
    getMenuFromCategory("Salad", $foodMenuItems);
    // Calling foods from salad category - Constantine
    ?>
</div>

<!--  Category Title - Constantine -->
<div class="row">
    <div class="box">
     <h2>Meat our Fantasies!</h2>
    </div>
</div>
<!--  !Category Title - Constantine -->

<div class="row">
<?php
    getMenuFromCategory("Meat", $foodMenuItems);
    // Calling foods from meat category - Constantine
    ?>
</div>

<?php include('includes/footer.php'); ?>

</body>

</html>


