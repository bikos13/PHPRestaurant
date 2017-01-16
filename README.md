# PHPRestaurant
A reservation for a Restaurant Web Application based on PHP

Readme File Under Development ...

Contents Table
1) General Information about the project
2) Web App Usage
  a) Database Configuration
  b) Food Catalogue
4) Project Status



1) General Information about the project:

- The design is based on the template 'Business Casual' provided by https://startbootstrap.com/template-overviews/business-casual/
- This project uses HTML5, CSS3, BOOTSTRAP, JAVASCRIPT, JQUERY, PHP7, MySQL (with mysqli methods)
- The Web App uses the plugin php-store-hours by coryetzkorn (Plugin on GitHub: https://github.com/coryetzkorn/php-store-hours) to provide realtime information about the open hours of the restaurant
- The Web App also uses the plugin validate.js by Rick Harrison (Plugin on Github: https://github.com/rickharrison/validate.js) 



2) Web App Usage:

a) Database Configuration

in phpmyadmin execute the script included in restaurant_db.sql
funtions/dbcon.php has 2 variables that should be changed according to usage
$username = "root"; // default is root, change it on your servers username
$password = ""; // default is empty, change it on your servers username

b) Food Catalogue

This project has only 2 predefined food categories (Meat and Salads)
It is being populated by the file includes/arrays.php so if your want to add or alter dishes

Example (includes/arrays.php):
"foodCategory" => "Meat", // or Salad if you wish
        "foodTitle" => "35 OZ. TOMAHAWK RIBEYE", // Food Title
        "foodImageSlug" => "tomahawk-ribeye-specials.jpg", //image being pulled from ./img/menuItems/ **Reccommended thumbnail size 320x180**
        "foodDescription" => "This massive, tender, juicy ribeye ...", // Make sure Description have around the same character length to avoid styling problems
        "foodPrice" => "50" // Price
        
In Addition, use the currency symbol of your liking at functions/foodCataloging.php Line 35 (Instructions included in file)



3) Project Status

Alpha version, it's not working after registration or login proccess, although registration in DB works!

Readme File Under Development ...
