<ul class="nav navbar-nav">
    <?php
    // Calling navMenuItems from arrays.php - Constantine
    foreach ($navMenuItemsGeneral as $item) {
        echo "<li><a href=" . $item['slug'] . ">" . $item['title'] . "</a></li>";
    }

    // Calling navMenuItems from arrays.php for logged IN users only- Constantine
    if (isset($_SESSION['loggedin'])) {
        foreach ($navMenuItemsLoggedIn as $item) {
            echo "<li><a href=" . $item['slug'] . ">" . $item['title'] . "</a></li>";
        }
    }
    
    // Calling navMenuItems from arrays.php for logged OUT users only- Constantine
    if (!(isset($_SESSION['loggedin']))) {
        foreach ($navMenuItemsLoggedOut as $item) {
            echo "<li><a href=" . $item['slug'] . ">" . $item['title'] . "</a></li>";
        }
    }
    ?>
</ul>