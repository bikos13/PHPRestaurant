<!--Page Meta - Constantine -->

<!--TITLE Constant is being used for the header <title> tag and also for the 'mobileTitle'  mobile version of class which echoes TITLE <!--Page Meta - Constantine -->
<?php define('TITLE', 'Contact us!'); ?>

<!--!Page Meta -->    

<?php
include('includes/header.php');
//Contact page requires phpstorehours.php to view the store hours properly, having as a fact that footer also uses the same implementation this elements MUST be included ONCE - Constantine 
include_once ('includes/phpstorehours.php');
?>

<!--Where to find us div - Constantine -->
<div class="row">
    <div class="box">
        <div class="col-lg-12">
            <hr>
            <h2 class="intro-text text-center">Contact
                <strong>DETAILS</strong>
            </h2>
            <hr>
        </div>
        <div class="col-md-8">
            <!-- Embedded Google Map using an iframe - Constantine -->
            <iframe width="100%" height="260" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d59304.50856869819!2d21.817799560433716!3d38.63026810644767!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x135efe799bedbba3%3A0xae2e8bbef18bcd60!2zzpXPgM6xz4Euzp_OtC4gzp3Osc-Fz4DOrM66z4TOv8-FIC0gzqDOu86xz4TOrM69zr_PhSAtIM6ozrfOu86_z40gzqPPhM6xz4XPgc6_z40sIM6dzrHPhc-AzrHOus-Ezq_OsSAzMDAgMjI!5e0!3m2!1sel!2sgr!4v1482850377816"></iframe>
        </div>
        <div class="col-md-4">
            <p>Phone:
                <strong>+30 26130 55055</strong>
            </p>
            <p>Email:
                <strong><a href="mailto:info@felipetakia.gr">info@felipetakia.gr</a></strong>
            </p>
            <p>Address:
                <strong>Likofotos 3 & Aetofolias
                    <br>Ano Katagogia, GR</strong>
            </p>
            <p>

                <!-- Calling short version of PHP Store hours - Constantine -->
                <?php
                echo '<table class="table table-striped" style="margin: 0;">';
                foreach ($store_hours->hours_this_week(true) as $days => $hours) {
                    echo '<tr>';
                    echo '<td>' . $days . '</td>';
                    echo '<td>' . $hours . '</td>';
                    echo '</tr>';
                }
                echo '</table>';

                //Calling php store hours message for being open or closed - Constantine
                echo '<p style="padding: 0;">';
                $store_hours->render();
                echo '</p>';
                ?>
                <!-- !Calling short version of PHP Store hours - Constantine -->

            </p>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<!-- ! Where to find us div - Constantine -->
<!-- ------------------------------------ -->
<!-- Contact Form Div -->

<div id="contact-form-field" class="row">
    <div class="box">

        <div class="col-lg-12">
            <hr>
            <h2 class="intro-text text-center">Contact us
                <strong>FORM</strong>
            </h2>
            <hr>

            <p style='text-align: center;'>Please feel free to contact us, using the provided form below!</p>
        </div>

        <?php
        //Include Validations.php which has PHP validation functions - Constantine
        include('functions/validations.php');

        // Defining variables and set to empty values - Constantine
        $name = $email = $phoneNumber = $msg = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = test_input($_POST["name"]);
            $email = test_input($_POST["email"]);
            $phoneNumber = test_input($_POST["phoneNumber"]);
            $msg = test_input($_POST["message"]);

            // Testing if the fields are filled - Constantine

            If ((empty($email)) || (empty($name)) || (empty($phoneNumber))) {
                echo "<span class='alert alert-danger'>All fields are required!<br><br><a href='/contact.php'><button class='btn btn-default'>Go back to Contact Form</button></a></span>";
                exit;
            }

            // Testing if the fields are filled correctly based on  their type - Constantine
            elseif ((!filter_var($email, FILTER_VALIDATE_EMAIL)) || (!preg_match("/^[a-zA-Z ]*$/", $name)) || (!preg_match("/^[1-9][0-9]{0,15}$/", $phoneNumber))) {
                echo "<div class='col-md-4 col-md-offset-4 alert alert-danger'><strong>Invalid input format.</strong><br>1) Name accepts only Letters from the Alphabet<br>2) E-mail should look like <strong>someone@mail.com</strong><br>3) Phone number should contain only numbers!<br><br><a href='/contact.php'><button class='btn btn-default'>Go back to Contact Form</button></a></div>";
                exit;
            }
        }

        if (isset($_POST['submit'])) {

            //Doing a header injection check from the provided function that is included in validations.php
            if (has_form_injection($name) || has_form_injection($email) || has_form_injection($phoneNumber)) {
                die(); // If true, kill it
            }
            //Form-to-Email Settings - Constantine
            //Form Reciptient's E-mail - Constantine
            $to = "constantinos-@hotmail.com";

            //E-mail Subject
            $subject = "$name sent you a message using Felipetakia's contact form";

            //E-mail Message
            $message = "Name: $name\r\n";
            $message .= "Email: $email\r\n";
            $message .= "Phone Number: $phoneNumber\r\n\r\n";
            $message .= "Message:\r\n$msg";

            //Restrict 72 letter per line for a clean e-mail view of the message - Constantine
            $message = wordwrap($message, 72);

            //Mail headers
            $headers = "MIME-Version 1.0\r\n";
            $headers .= "Content-type: text/plain; charset=utf-8\r\n"; //Used UTF-8 instead of iso-8859 suggested - Constantine
            $headers .= "From: $name <$email>\r\n";
            $headers .= "X-Priority: 1\r\n";
            $headers .= "X-MSMail-Priority: High\r\n\r\n";

            //Send E-mail (WARNING: This will not work on localhost servers if it's not setup properly)
            mail($to, $subject, $message, $headers);
            ?>

            <!-- Success Message -->

            <div class="col-md-6 col-md-offset-3">
                <div style="text-align: center;" class=" alert alert-success">

                    <?php echo $name; ?>, your message has been delivered <strong>Successfully!</strong><br>
                    We will reply to you within the next two hours!<br><br>
                    <a href="index.php" class="btn btn-default">Go back to Home page</a>

                </div>
            </div>


            <!-- !Success Message -->

        <?php } else { ?>

            <!--  If none of the above is happening (eg. Post, Form Submission etc.) The view the following form - Constantine -->

            <form role="form" method="POST" id="contact-form" name="contact-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                <div class="row">

                    <!-- Error Field - Constantine -->

                    <div class="form-group col-lg-6 col-lg-offset-3">
                        <div class="error_box"></div>
                    </div>

                    <!-- Name Field - Constantine -->

                    <div class="form-group col-lg-4">
                        <label>Name<em style="color:red;"> *</em></label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <!-- E-mail Adress Field - Constantine -->

                    <div class="form-group col-lg-4">
                        <label>Email Address<em style="color:red;"> *</em></label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <!-- Phone Number Field - Constantine -->

                    <div class="form-group col-lg-4">
                        <label>Phone Number<em style="color:red;"> *</em></label>
                        <input type="tel" id="phoneNumber" name="phoneNumber" class="form-control" required>
                    </div>

                    <!-- Message TextArea Field - Constantine -->

                    <div class="clearfix"></div>
                    <div class="form-group col-lg-12">
                        <label>Message<em style="color:red;"> *</em></label>
                        <textarea class="form-control" rows="6" id="message" name="message" required></textarea>
                    </div>

                    <!-- Submit Button Field - Constantine -->

                    <div class="form-group col-lg-12">
                        <!-- <input type="hidden" name="save" value="contact"> (COMMENTED OUT Older Version) - Constantine-->
                        <button type="submit" id="submit" name="submit" class="btn btn-default"><span class="glyphicon glyphicon-envelope"></span> Send Message </button>
                    </div>

                    <!-- End of Form Elements - Constantine -->

                </div>
            </form>

        <?php } ?>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<!-- Calling Rick Harrissons validate.js MORE AT: http://rickharrison.github.io/validate.js/ - Constantine -->
<script type ="text/javascript" src="js/validate.js"></script>

<!-- Custom Form JS Validation Rules Script - Constantine -->

<script>
    var validator = new FormValidator('contact-form', [{
            name: 'name',
            display: 'Name',
            rules: 'max-length[50]'
        }, {
            name: 'email',
            display: 'E-mail',
            rules: 'valid_email'
        }, {
            name: 'phoneNumber',
            display: 'Phone Number',
            rules: 'decimal|max-length[20]'
        }], function (errors, event) {
            var SELECTOR_ERRORS = $('.error_box'),
                SELECTOR_SUCCESS = $('.success_box');

    if (errors.length > 0) {
        SELECTOR_ERRORS.empty();

        for (var i = 0, errorLength = errors.length; i < errorLength; i++) {
            SELECTOR_ERRORS.append(errors[i].message + '<br />');
        }

        SELECTOR_SUCCESS.css({ display: 'none' });
        SELECTOR_ERRORS.fadeIn(200);
    } else {
        SELECTOR_ERRORS.css({ display: 'none' ; color: 'red' });
        SELECTOR_SUCCESS.fadeIn(200);
    }

    if (evt && evt.preventDefault) {
        evt.preventDefault();
    } else if (event) {
        event.returnValue = false;
    }
}
        //{
        //  var errorbox = document.getElementById('berichten');
        //var errstr = '';
        //if (errors.length > 0) {
        //  }
        //}
    );

</script>

<!-- !Custom Form JS Validation Rules Script - Constantine -->
<!-- !Calling Rick Harrissons validate.js MORE AT: http://rickharrison.github.io/validate.js/ - Constantine -->


</body>

</html>
