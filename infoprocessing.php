<?php

// Starting Session - Constantine
session_start();
//Including Database Connection function - Constantine
include "./functions/dbcon.php";

//Including validation.php functions - Constantine
include "./functions/validations.php";


if (isset($_POST['registerform']) || isset($_POST['loginform'])) { //Checking if the forms from the page where used - Constantine
    // Cleaning username and password by using the appropriate function before using them in either forms - Constantine
    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);
    // !Cleaning username and password by using the appropriate function before using them in either forms - Constantine


    if (isset($_POST['registerform']) && $_POST['registerform']) { //If registration form has been posted do the following - Constantine
        //Validating inputs - Constantine
        $fname = test_input($_POST['fname']);
        $lname = test_input($_POST['lname']);
        $email = test_input($_POST['email']);
        $phoneNumber1 = test_input($_POST['phoneNumber1']);
        $phoneNumber2 = test_input($_POST['phoneNumber2']);
        $passwordRepeat = test_input($_POST['passwordRepeat']);
        //! End of Validate inputs - Constantine
        

        //-------------------------------------------------
        //Checking if username already exists - Constantine
        //Checking if email already exists - Constantine
        //-------------------------------------------------
        

        //Checking if password equals password repeated field - Constantine
        if ($password !== $passwordRepeat) {

            //Pass a session warnings message to register.php form to indicatie to the user to input two identical passwords
            $_SESSION['warnings'] = "Please make sure that Password and Password Re-type fields match!";
            header("Location: register.php");
            die("<strong>Passwords entered do not match!</strong> <br><a href='register.php'><input type='button' value='Go back to registration form'></a>"); // If redirection fails die - Constantine
        }

        //Checking if password is with 5 characters minimum - Constantine
        if (strlen($password) <= '7') {
            $_SESSION['warnings'] = "<strong>Make sure that password is at least 8 characters long!</strong>";
            header("Location: register.php");
            die("Your Password Must Contain At Least 8 Characters! <br><a href='register.php'><input type='button' value='Go back to registration form'></a>"); // If redirection fails die - Constantine
        }

        //Calling Register sequence - Constantine
        if (isset($username) && !empty($username) && isset($password) && !empty($password) && isset($passwordRepeat) && !empty($passwordRepeat) && isset($fname) && !empty($fname) && isset($lname) && !empty($lname) && isset($email) && !empty($email) && isset($phoneNumber1) && !empty($phoneNumber1)) {
            //If the fields are filled - Constantine
            //
                //Hash password in MD5 - Constantine
            $password = md5($password);

            //DB Entry preparation - Constantine
            if ($stmt = $mysqli->prepare('INSERT INTO users(FIRSTNAME, LASTNAME, USERNAME, USERPASS, EMAIL, CONTACT_NUMBER_1, CONTACT_NUMBER_2) VALUES (?, ?, ?, ?, ?, ?, ?)')) {
                //Value Binding - Constantine
                $stmt->bind_param('sssssss', $fname, $lname, $username, $password, $email, $phoneNumber1, $phoneNumber2);
                $stmt->execute();
                $stmt->close();

                //If everything works perfectly, set message in session variables and redirection - Constantine
                $_SESSION['message'] = "Registration Successful! " . $fname . ", please feel free to login here!";
                header("Location: login.php");
            }
            $mysqli->close();
            // !Value Binding and Database Entry End  - Constantine
        } else {
            //If NOT all parameters have been entered in registration form are not valid, then pass a message to registration form through session variable - Constantine
            echo "No valid submissions has been found. Please go back and make sure that every field has been filled correctly in the previous form";
            $_SESSION['warnings'] = "Please fill all the required fields indicated with <em style='color:red;'>*</em> in registration form";
            header("Location: register.php");
        }

        // !Database Entry Sequence, else statement if not all required fields are filled .. End - Constantine
        // Registration form sequence End and Login Form sequence start- Constantine
        
        
    } elseif (isset($_POST['loginform']) && $_POST['loginform']) { //If loginform has been posted do the following - Constantine
        if (isset($username) && !empty($username) && isset($password) && !empty($password)) { //If login fields are filled check the database for a match - Constantine
            //Hash password in MD5 - Constantine
            $password = md5($password);

            if ($stmt = $mysqli->prepare("SELECT USERNAME FROM users WHERE USERNAME = ? AND USERPASS = ?")) {

                $stmt->bind_param('ss', $username, $password); // Setting Query parameters  - Constantine
                $stmt->execute(); // Executing Query  - Constantine
                $stmt->bind_result($record_returned); //Binding the result into the record_returned variable  - Constantine
                $stmt->fetch(); //Fetcing record from DB that matches the query  - Constantine
                $stmt->close(); //End of statement  - Constantine
            }
            $mysqli->close(); //Closing mysqli object - Constantine

            if ($record_returned == null) { //If user record is not found - Constantine
                $_SESSION['warnings'] = "Wrong Username/Password Combination"; // Pass a message into warnings SESSION Variable login form - Constantine
                header("Location: login.php"); //Redirect to login form (passing the message) - Constantine
                die("Wrong Username/Password Combination"); // If redirection fails die - Constantine
            } else { // If everything works (Database record found) then create the session variables needed to go forth - Constantine
                $_SESSION['loggedin'] = true;
                $_SESSION['user'] = $record_returned;
                header("Location: profile.php");
            }
        } else { //If not both fields are filled redirect a message through SESSION variable to login form - Constantine
            $_SESSION['warnings'] = "Please fill in both fields";
            header("Location: login.php");
            die("Please fill in both fields"); // If redirection fails die - Constantine
        }
    }
}
// !End of Check if website forms login or registration have been used sequence - Constantine
?>