<?php

// Starting Session - Constantine
session_start();
//Including Database Connection function - Constantine
include "dbcon.php";

//Including validation.php functions - Constantine
include "validations.php";


if (isset($_POST['registerform']) || isset($_POST['loginform'])) { //Checking if the forms from the page where used - Constantine


    //=============================================================================================
    // Cleaning username and password by using the appropriate function before using them in either forms - Constantine
    //=============================================================================================
    
    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);
    
    
    
    // End of cleaning username and password by using the appropriate function before using them in either forms
    //=============================================================================================


    if (isset($_POST['registerform']) && $_POST['registerform']) { //If registration form has been posted do the following - Constantine
        //Validating inputs - Constantine
        $fname = test_input($_POST['fname']);
        $lname = test_input($_POST['lname']);
        $email = test_input($_POST['email']);
        $phoneNumber1 = test_input($_POST['phoneNumber1']);
        $phoneNumber2 = test_input($_POST['phoneNumber2']);
        $passwordRepeat = test_input($_POST['passwordRepeat']);
        //! End of Validate inputs - Constantine
        
        
        
        //=============================================================================================
        //Checking if Username or E-mail already exists - Constantine =================================
        //=============================================================================================
        
        if ($stmt = $mysqli->prepare("SELECT USERNAME FROM users WHERE USERNAME = ?")) { //Checking if username exists in Database

            $stmt->bind_param('s', $username); // Setting Query parameters  - Constantine
            $stmt->execute(); // Executing Query  - Constantine
            $stmt->bind_result($username_valid_ret); //Binding the result into the username_valid_ret variable  - Constantine
            $stmt->fetch(); //Fetcing record from DB that matches the statement query - Constantine
            $stmt->close(); //End of statement  - Constantine
        }

        if ($username_valid_ret != null) { //If user record is not found - Constantine
            $_SESSION['warnings'] = "Username already exists. You can try the login page. <a href='login.php'>Click here</a>"; // Pass a message into warnings SESSION Variable login form - Constantine
            $mysqli->close();
            header("Location: ../register.php"); //Redirect to login form (passing the message) - Constantine
            die("Username or Email already exists"); // If redirection fails die - Constantine   
        }

        if ($stmt = $mysqli->prepare("SELECT EMAIL FROM users WHERE EMAIL = ?")) { //Checking if e-mail exists in Database

            $stmt->bind_param('s', $email); // Setting Query parameters  - Constantine
            $stmt->execute(); // Executing Query  - Constantine
            $stmt->bind_result($email_valid_ret); //Binding the result into the email_valid_ret variable  - Constantine
            $stmt->fetch(); //Fetcing record from DB that matches the statement query - Constantine
            $stmt->close(); //End of statement  - Constantine
        }

        if ($email_valid_ret != null) { //If user record is not found - Constantine
            $_SESSION['warnings'] = "E-mail already exists. You can try the login page. <a href='login.php'>Click here</a>"; // Pass a message into warnings SESSION Variable login form - Constantine
            $mysqli->close();
            header("Location: ../register.php"); //Redirect to login form (passing the message) - Constantine
            die("Username or Email already exists"); // If redirection fails die - Constantine  
        }
        
        
        // End of checking if Username or E-mail already exists =======================================
        //=============================================================================================
        
        
        
        //Calling Register sequence - Constantine
        if (isset($username) && !empty($username) && isset($password) && !empty($password) && isset($passwordRepeat) && !empty($passwordRepeat) && isset($fname) && !empty($fname) && isset($lname) && !empty($lname) && isset($email) && !empty($email) && isset($phoneNumber1) && !empty($phoneNumber1)) {
            //Checking if the fields are filled - Constantine
            
            
            
            //=============================================================================================
            // Checking input type validation - Constantine ===============================================
            //=============================================================================================

            $errorTrigger = false; // Initializing Error trigger
            $errorMessage = "<ul>"; //Initializing Error message

            if (!preg_match("/^[a-zA-Z ]*$/", $fname)) {
                $errorMessage .= "<li>Only letters and white space allowed in the <strong>first name</strong> field</li>";
                $errorTrigger = true;
            }

            if (!preg_match("/^[a-zA-Z ]*$/", $lname)) {
                $errorMessage .= "<li>Only letters and white space allowed in the <strong>last name</strong> field</li>";
                $errorTrigger = true;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errorMessage .= "<li>Invalid <strong>email</strong> format </li>";
                $errorTrigger = true;
            }
            if ((!preg_match("/^[\+0-9\-\(\)\s]*$/", $phoneNumber1)) || (!preg_match("/^[\+0-9\-\(\)\s]*$/", $phoneNumber2))) {
                $errorMessage .= "<li>Only numbers are allowed in <strong>Contact Numbers</strong></li>";
                $errorTrigger = true;
            }

            if (strlen($password) <= '7') {
                $errorMessage .= "<li><strong>Make sure that password is at least 8 characters long!</strong></li>";
                $errorTrigger = true;
            }

            if ($password !== $passwordRepeat) {

                //Pass a session warnings message to register.php form to indicatie to the user to input two identical passwords
                $errorMessage .= "<li>Please make sure that Password and Password Re-type fields match!</li>";
                $errorTrigger = true;
            }

            if ($errorTrigger == true) {
                $errorMessage .= "</ul>";
                $_SESSION['warnings'] = $errorMessage;
                header('Location: ../register.php');
                die($errorMessage);
            } else {
                unset($errorMessage);
                unset($errotTrigger);
            }


            // End of Checking input type validation - Constantine ========================================
            //=============================================================================================
            
            
            
            $password = md5($password); //Hash password in MD5 - Constantine
            
            
            
            //=============================================================================================
            //Inserting user into Database - Constantine ==================================================
            //=============================================================================================
            
            
            if ($stmt = $mysqli->prepare('INSERT INTO users(FIRSTNAME, LASTNAME, USERNAME, USERPASS, EMAIL, CONTACT_NUMBER_1, CONTACT_NUMBER_2) VALUES (?, ?, ?, ?, ?, ?, ?)')) {
                //Value Binding - Constantine
                $stmt->bind_param('sssssss', $fname, $lname, $username, $password, $email, $phoneNumber1, $phoneNumber2);
                $stmt->execute();
                $stmt->close();

                //If everything works perfectly, set message in session variables and redirection - Constantine
                $_SESSION['message'] = "Registration Successful! " . $fname . ", please feel free to login here!";
                header("Location: ../login.php");
            }
            $mysqli->close();
            

            // End Inserting user into Database - Constantine =============================================
            //=============================================================================================            
            
            
            
            
            
            // !Value Binding and Database Entry End  - Constantine
        } else {
            //If NOT all parameters have been entered in registration form are not valid, then pass a message to registration form through session variable - Constantine
            echo "No valid submissions has been found. Please go back and make sure that every field has been filled correctly in the previous form";
            $_SESSION['warnings'] = "Please fill all the required fields indicated with <em style='color:red;'>*</em> in registration form";
            header("Location: ../register.php");
        }

        // !Database Entry Sequence, else statement if not all required fields are filled .. End - Constantine
        // Registration form sequence End and Login Form sequence start- Constantine
    } elseif (isset($_POST['loginform']) && $_POST['loginform']) { //If loginform has been posted do the following - Constantine
        if (isset($username) && !empty($username) && isset($password) && !empty($password)) { //If login fields are filled check the database for a match - Constantine
            //Hash password in MD5 - Constantine
            $password = md5($password);

            if ($stmt = $mysqli->prepare("SELECT USER_ID, USERNAME, FIRSTNAME, LASTNAME, IS_ADMIN FROM users, userlevels WHERE USERNAME = ? AND USERPASS = ? AND users.UserLevels_USERLEVEL_ID = userlevels.USERLEVEL_ID")) {

                $stmt->bind_param('ss', $username, $password); // Setting Query parameters  - Constantine
                $stmt->execute(); // Executing Query  - Constantine
                $stmt->bind_result($user_id_returned, $username_returned, $firstname_returned, $lastname_returned, $isadmin); //Binding the result into the record_returned variable  - Constantine
                $stmt->fetch(); //Fetcing record from DB that matches the query in array schema  - Constantine
                $stmt->close(); //End of statement  - Constantine
            }
            $mysqli->close(); //Closing mysqli object - Constantine

            if ($username_returned == null) { //If user record is not found - Constantine
                $_SESSION['warnings'] = "Wrong Username/Password Combination"; // Pass a message into warnings SESSION Variable login form - Constantine
                header("Location: ../login.php"); //Redirect to login form (passing the message) - Constantine
                die("Wrong Username/Password Combination"); // If redirection fails die - Constantine
            } else { // If everything works (Database record found) then create the session variables needed to go forth - Constantine
                $_SESSION['loggedin'] = true;
                $_SESSION['userdata'] = array(
                    "userid" => $user_id_returned,
                    "username" => $username_returned,
                    "firstname" => $firstname_returned,
                    "lastname" => $lastname_returned,
                    "isadmin" => $isadmin);
                header("Location: ../profile.php?panel=home");
            }
        } else { //If not both fields are filled redirect a message through SESSION variable to login form - Constantine
            $_SESSION['warnings'] = "Please fill in both fields";
            header("Location: ../login.php");
            die("Please fill in both fields"); // If redirection fails die - Constantine
        }
    }
}
// !End of Check if website forms login or registration have been used sequence - Constantine
?>