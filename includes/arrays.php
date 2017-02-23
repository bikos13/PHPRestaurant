<?php

/*
 * arrays.php
 * -----------------------
 * Navigation Items Array
 * Food Menu Items Array
 */

/*
 * Nav Menu Items
 * slug is used for the href linking
 * title is used for the nav's button displayed title
 * viewLevel is used along with database user levels (which is used
 *      as Session Variable to indicate until which level this menu item appears
 *      for example: Login And Register Appear only in level 0 (Guests) users
 * needsAdmin is being used to indicate that this menu should appear on admin
 *      user Roles Only
 * - Constantine
 */


//General Menu items appear in every session state - Constantine

$navMenuItemsGeneral = array(
    array(
        "slug" => "index.php",
        "title" => "Home"
    ),
    array(
        "slug" => "menu.php",
        "title" => "Menu"
    ),
    array(
        "slug" => "MakeAReservation.php",
        "title" => "<strong>Reservation</strong>"
    ),
    array(
        "slug" => "contact.php",
        "title" => "Contact",
    ),
);

// Items that appear when session status is NOT logged in - Constantine
$navMenuItemsLoggedOut = array(
    
    array(
        "slug" => "login.php",
        "title" => "Login"
    ),
    array(
        "slug" => "register.php",
        "title" => "Register"
    ),
);

// Items that appear when session status IS logged in - Constantine

$navMenuItemsLoggedIn = array(
    
    array(
        "slug" => "profile.php?panel=home",
        "title" => "PROFILE"
    ),
    
    array(
        "slug" => "logout.php",
        "title" => "LOGOUT"
    ),
);

//Admin Menu items appear in is_admin session state - Constantine
$navMenuItemsAdmin = array(
    
    array(
        "slug" => "adminIndex.php?panel=controlPanel",
        "title" => "Admin"
    )
);

//================================================================
//Members Area Menu (Left Panel)
//================================================================

$membersMenuItems = array(
    array(
        "slug" => "profile.php?panel=home",
        "title" => "Profile Home"
    ),
    array(
        "slug" => "profile.php?panel=newReservation",
        "title" => "Make a Reservation"
    ),
    array(
        "slug" => "profile.php?panel=viewReservations&page=1",
        "title" => "View Reservations history"
    )
);

//================================================================
//Admin Area Menu (Left Panel)
//================================================================

$adminMenuItems = array(
    array(
        "slug" => "adminIndex.php?panel=controlPanel",
        "title" => "Admin Panel"
    ),
    array(
        "slug" => "adminIndex.php?panel=members&page=1",
        "title" => "New Reservation"
    ),
    array(
        "slug" => "adminIndex.php?panel=newCustomer",
        "title" => "New Customer"
    ),
    array(
        "slug" => "adminIndex.php?panel=viewReservations&page=1",
        "title" => "View Reservations"
    ),
    array(
        "slug" => "adminIndex.php?panel=setStoreHours",
        "title" => "Manage Hours"
    ),
    array(
        "slug" => "adminIndex.php?panel=manageTables&page=1",
        "title" => "Manage Tables"
    )
);


/*
 * Food Menu Items Array
 * - Constantine
 */

$foodMenuItems = array(
    array(
        "foodCategory" => "Meat",
        "foodTitle" => "35 OZ. TOMAHAWK RIBEYE",
        "foodImageSlug" => "tomahawk-ribeye-specials.jpg",
        "foodDescription" => "This massive, tender, juicy ribeye is wood-fire grilled, cooked to absolute perfection and topped with roasted garlic butter. Served with one freshly made side.",
        "foodPrice" => "50"
    ),
    array(
        "foodCategory" => "Meat",
        "foodTitle" => "22 OZ. BONE-IN RIBEYE",
        "foodImageSlug" => "bone-in-ribeye-bbs-specials.jpg",
        "foodDescription" => "This wood-fire grilled ribeye is juicy, bone-in and extra marbled for maximum tenderness. Served with a signature potato and one freshly made side.",
        "foodPrice" => "35"
    ),
    array(
        "foodCategory" => "Meat",
        "foodTitle" => "FELIPE'S FILET MIGNON",
        "foodImageSlug" => "victorias-filet-specials.jpg",
        "foodDescription" => "Felipe’s Filet® Mignon cooked to perfection, topped with roasted garlic butter and served with a signature potato and one freshly made side.",
        "foodPrice" => "60"
    ),
    array(
        "foodCategory" => "Meat",
        "foodTitle" => "CALIFORNIA BBQ CHICKEN WINGS",
        "foodImageSlug" => "california_spicy_bbq_chicken.jpg",
        "foodDescription" => "Ever heard of the most delicious tasty  Californian BBQ Spicy Chicken Wings. Perfection is the source of our motivation, making our chefs drolling whiel preparing this unique meal.",
        "foodPrice" => "30"
    ),
    array(
        "foodCategory" => "Meat",
        "foodTitle" => "COWBOY BUFFALO EXTREME CHOPS",
        "foodImageSlug" => "cowboy_buffalo_extreme_chops.jpg",
        "foodDescription" => "Our restaurant hunters, have collected the most premium quality meat from Buffalos from Trinidad and Tobago! Chops have won the title of the best dish in world's most favourite 3 years in a row!",
        "foodPrice" => "100"
    ),
    array(
        "foodCategory" => "Meat",
        "foodTitle" => "DON'T MAKE WAR, MAKE BURGER",
        "foodImageSlug" => "the_burger.jpg",
        "foodDescription" => "None knows the true taste of THE BURGER till he tried this particular one. 50 oz. burger OMFG!!! Can't wait to taste it? Then join us and you will have the chance to taste HEAVEN OF MEATS!!!!",
        "foodPrice" => "50"
    ),
    array(
        "foodCategory" => "Salad",
        "foodTitle" => "GREEK SALAD",
        "foodImageSlug" => "greek-salad-whole.desktop.jpg",
        "foodDescription" => "Romaine, vine-ripened tomatoes, feta, pickled red onions and kalamata olives with salt and pepper tossed with Greek dressing. Available in whole and half. ",
        "foodPrice" => "15"
    ),
    array(
        "foodCategory" => "Salad",
        "foodTitle" => "MODERN GREEK SALAD",
        "foodImageSlug" => "modern-greek-salad-with-quinoa-whole.desktop.jpg",
        "foodDescription" => "Romaine, kale, quinoa tomato sofrito blend, diced cucumbers and kalamata olives tossed with Greek dressing and topped with feta and toasted almonds. Available in whole and half.",
        "foodPrice" => "20"
    ),
    array(
        "foodCategory" => "Salad",
        "foodTitle" => "CHINESE CITRUS CASHEW SALAD WITH CHICKEN",
        "foodImageSlug" => "chinese-citrus-cashew-with-chicken-salad-whole.desktop.jpg",
        "foodDescription" => "Chicken raised without antibiotics, romaine, napa cabbage blend, diced cucumbers, fresh pineapple and cilantro tossed with soy-miso lime dressing and topped with mandarin oranges, roasted cashew pieces and hoisin sauce.",
        "foodPrice" => "25"
    ),
    array(
        "foodCategory" => "Salad",
        "foodTitle" => "SPICY THAI SALAD WITH CHICKEN",
        "foodImageSlug" => "thai-chicken-salad-whole.desktop.jpg",
        "foodDescription" => "Chicken raised without antibiotics, romaine, roasted cashew pieces, fire-roasted edamame, red pepper and carrot blend, cilantro and wonton strips tossed with low-fat Thai chili vinaigrette and drizzled with peanut sauce. Available in whole and half.",
        "foodPrice" => "25"
    ),
);
?>
