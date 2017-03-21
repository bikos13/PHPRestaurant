<?php
    //Including globally needed functions and arrays - Constantine
    include('functions/init.php');
    
    //! Including globally needed functions and arrays - Constantine
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="The most eccentric and highest taste and quality restaurant of the World!">
    <link rel="shortcut icon" type="image/png" href="../img/favicon.png"/>
    <meta name="author" content="Constantine Stathis">
    
    <!--Echoing Title page from individual page's meta - Constantine -->
    <title><?php echo TITLE; ?> | Felipetakia.gr</title>
    <!--!Echoing Title page from individual page's meta - Constantine -->

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">
    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

</head>

<!-- Body Starts from the header.php section because the navigation is global -Constantine -->

<body>

    <div class="brand">Felipetakia</div>
    <div class="address-bar">Likofotos 3 & Aetofolias | Ano Katagogia | +30 26130 55055</div>

    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <!-- 3-line Icon -->
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <!-- !3-line Icon -->
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="index.php">Felipetakia</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		
                <!-- Menu items are being collected from nav.php - Constantine -->
                <?php include('includes/nav.php'); ?>
                <!-- !Menu items are being collected from nav.php - Constantine -->
                
            </div>
            <!-- /.navbar-collapse -->
            </div>
        
        <!-- /.container -->
    </nav>
    
   <!--Calling TITLE constant in mobile devices for navigation-clarification reasons - Constantine -->
    <?php include('includes/mobileTitle.php'); ?>
   <!--!Calling TITLE constant in mobile devices for navigation-clarification reasons - Constantine -->

   <!--Opening container for each page following (This div closes in footer.php - Constantine-->
   <div class="container">