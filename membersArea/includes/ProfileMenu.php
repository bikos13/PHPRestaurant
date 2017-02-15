
    <div class="col-md-3" id='UserMenu'>
        <div class="box">
        <h4>Hello, <?php echo $_SESSION['userdata']['firstname']; ?></h4><br>
        <div class="dropdown">

            <button class="btn btn-primary dropdown-toggle profilebtn" type="button" data-toggle="dropdown"> <?php echo $_SESSION['userdata']['firstname']; ?>'s Menu <span class="caret"></span></button>
            <ul class="dropdown-menu">
                
                <?php // Calling the admin $navMenuItems from the arrays.php which is included in headerAdmin.php - Constantine

                foreach ($membersMenuItems as $item) {
                    echo "<li><a href='" . $item['slug'] . "' > " . $item['title'] . " </a></li>";
                }
                
                ?>
                
            </ul>
        </div>
        <h4><?php echo date('l,  d m Y') ?></h4><br>
    </div>
</div>