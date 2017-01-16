<ul class="nav navbar-nav">
    <?php
    // Calling navMenuItems from arrays.php - Constantine
        foreach ($navMenuItems as $item) {
            echo "<li><a href=".$item['slug'].">".$item['title']."</a></li>";
    }
    ?>
</ul>