<?php

//Including Database Connection function - Constantine
include "./functions/dbcon.php";

//Includeing validation.php functions - Constantine
include "./functions/validations.php";

//Check if password entries match - Constantine
//Check if the forms from the page where used - Constantine
if (isset($_POST['registerform']) || isset($_POST['loginform'])) {

    //Check that all required fields are filled after they have been tested with test_input function - Constantine
    if (isset($_POST['registerform']) && $_POST['registerform']) {
        //Validate inputs - Constantine
        $username = test_input($_POST['username']);
        $password = test_input($_POST['password']);
        $passwordRepeat = test_input($_POST['passwordRepeat']);

        //Checking if password equals password repeated field - Constantine
        if ($password !== $passwordRepeat) {
            die("Passwords entered do not match! <br><a href='register.php'><input type='button' value='Go back to registration form'></a>");
        }
        
        //Checking if password is with 5 characters minimum - Constantine
        if (strlen($password) <= '8') {
            die("Your Password Must Contain At Least 8 Characters! <br><a href='register.php'><input type='button' value='Go back to registration form'></a>");
        }
        
        //-------------------------------------------------
        //Checking if username already exists - Constantine
        //Code here
        //Checking if email already exists - Constantine
        //Code here
        //-------------------------------------------------

        $fname = test_input($_POST['fname']);
        $lname = test_input($_POST['lname']);
        $email = test_input($_POST['email']);
        $phoneNumber1 = test_input($_POST['phoneNumber1']);
        $phoneNumber2 = test_input($_POST['phoneNumber2']);


        //Calling Register sequence - Constantine
        if (isset($username) && !empty($username) && isset($password) && !empty($password) && isset($passwordRepeat) && !empty($passwordRepeat) && isset($fname) && !empty($fname) && isset($lname) && !empty($lname) && isset($email) && !empty($email) && isset($phoneNumber1) && !empty($phoneNumber1)) {
            //If the fields are filled - Constantine
            //
                //Hash password in MD5 - Constantine
            $password = md5($password);

            //DB Entry preparation - Constantine
            if ($stmt = $mysql->prepare('INSERT INTO users(FIRSTNAME, LASTNAME, USERNAME, USERPASS, EMAIL, CONTACT_NUMBER_1, CONTACT_NUMBER_2) VALUES (?, ?, ?, ?, ?, ?, ?)')) {
                //Value Binding - Constantine
                $stmt->bind_param('sssssss', $fname, $lname, $username, $password, $email, $phoneNumber1, $phoneNumber2);
                $stmt->execute();
                $stmt->close();
            }
            // !Value Binding End  - Constantine
        }
        // !Register Sequence End - Constantine
    }
    // !Website forms used (Checking if fields are filled End - Constantine
}
// !Cheeck if website forms login or registration have been used
else {
    //If parameters entered are not valid - Constantine
    echo "No valid submissions has been found. Please go back and make sure that every field has been filled correctly in the previous form";
}
?>