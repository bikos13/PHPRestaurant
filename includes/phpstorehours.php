<!DOCTYPE html>
<!--phpstorehours.php implements the StoreHours.class.php including the variables below
In addition every php expression that can be used from this plugin has been commented out
and it can be used individually on other elements (footer.php and contact.php use the present
PHP file as a required source) - Constantine-->
<html lang="en" xml:lang="en"><head>
    <meta charset="utf-8">

    <head>
        <title>PHP Store Hours</title>

        <style type="text/css">
        body {
            font-family: 'Helvetica Neue', arial;
            text-align: center;
        }
        table {
            font-size: small;
            text-align: left;
            margin: 100px auto 0 auto;
            border-collapse: collapse;
        }
        td {
            padding: 2px 8px;
            border: 1px solid #ccc;
        }
        </style>
    </head>

    <body>

    <?php

    // REQUIRED
    date_default_timezone_set('Europe/Athens');
    // Include the store hours class
    require 'functions/StoreHours.class.php';

    // REQUIRED
    // Define daily open hours
    // Must be in 24-hour format, separated by dash
    // If open multiple times in one day, enter time ranges separated by a comma
    $hours = array(
        'mon' => array('14:00-22:00'),
        'tue' => array('16:00-00:00'),
        'wed' => array('14:00-22:00'),
        'thu' => array('16:00-00:00'),
        'fri' => array('16:00-00:00'),
        'sat' => array('14:00-00:00'),
        'sun' => array('16:00-00:00')
    );

    // OPTIONAL
    // Add exceptions (great for holidays etc.)
    // MUST be in a format month/day[/year] or [year-]month-day
    // Do not include the year if the exception repeats annually
    $exceptions = array(
        '1/1'  => array()
    );

    // OPTIONAL
    // Place HTML for output below. This is what will show in the browser.
    // Use {%hours%} shortcode to add dynamic times to your open or closed message.
    $template = array(
        'open'           => "<span class='text-success'>Yes, we're open! Today's hours are {%hours%}.</span>",
        'closed'         => "<span class='text-danger'>Sorry, we're closed at the moment. Today's hours are {%hours%}.</span>",
        'closed_all_day' => "<span class='text-danger'>Sorry, we're closed today.</span>",
        'separator'      => " - ",
        'join'           => " and ",
        'format'         => "g:ia", // options listed here: http://php.net/manual/en/function.date.php
        'hours'          => "{%open%}{%separator%}{%closed%}"
    );

    // Instantiate class
    $store_hours = new StoreHours($hours, $exceptions, $template);
    
    // Call render method to output open / closed message
    //echo '<p style="padding: 0;">';
    //$store_hours->render();
    //echo '</p>';

    // Display full list of open hours (for a week without exceptions)
    //echo '<table class="table table-striped" style="margin:0;">';
    //foreach ($store_hours->hours_this_week() as $days => $hours) {
     //   echo '<tr>';
      //  echo '<td>' . $days . '</td>';
      //  echo '<td>' . $hours . '</td>';
      //  echo '</tr>';
    //}
    //echo '</table>';

    // Same list, but group days with identical hours
    //echo '<table>';
    //foreach ($store_hours->hours_this_week(true) as $days => $hours) {
    //    echo '<tr>';
    //    echo '<td>' . $days . '</td>';
    //    echo '<td>' . $hours . '</td>';
    //    echo '</tr>';
    //}
    //echo '</table>';
    
    
    ?>

    </body>

</html>
