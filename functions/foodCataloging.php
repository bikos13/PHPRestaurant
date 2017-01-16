<?php

include_once("./includes/arrays.php");




/* This function calls the food Items from a particular category given as an input
 * and created a Bootstrap polished block withing the menu page
 * if statement catures the category given from the input and filters out irrelevant categories
 *   - Constantine */

function getMenuFromCategory($category,$foodMenuItems) {
    foreach ($foodMenuItems as $food) {
        if ($category === $food['foodCategory']) {
    
            echo "<div class='col-sm-6'>";
            echo "<div class='box'>";
            echo "<div class='row'>";
            echo "<div class='col-sm-12'>";
            echo "<h3> " . $food['foodTitle'] . " </h3>";
            echo "<hr>";
            echo "</div></div>";
            echo "<div class='row'>";
            echo "<div class='col-sm-12'>";
            echo "<img src='./img/menuItems/".$food['foodImageSlug']."' class='img-circle img-responsive' alt='".$food['foodTitle']."' style='margin: 0 auto;'>";
            echo "<hr>";
            echo "</div></div>";
            echo "<div class='row'>";
            echo "<div class='col-sm-12'>";
            echo "<p>".$food['foodDescription']."</p>";
            echo "</div></div>";
            echo "<div class='row'>";
            echo "<div class='col-sm-12'>";
            echo "<h1><span class='label label-default'>". $food['foodPrice']." &euro;</span></h1>";
            echo "</div></div></div></div>";
        }
}
}

?>

