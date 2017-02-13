<?php

//Function that Prevents Form Header Injection - Constatnine
function has_form_injection($str) {
    $str = preg_match("/[\r\n]/", $str);
    return $str;
}

//Function that prevents malicious content parsing by sanitizing - Constantine
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = filter_var($data, FILTER_SANITIZE_STRING);

    return $data;
}

//This function sanitizes pagination page variable inputs - Constantine
function test_GET_page($getPage) {
    if (!filter_var($getPage, FILTER_VALIDATE_INT) === false) {
        return $getPage;
    }
    else {
        die("Invalid input detected!");
    }
}
?>