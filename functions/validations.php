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

?>