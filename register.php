<!--Page Meta - Constantine -->
<!--TITLE Constant is being used for the header <title> tag and also for the 'mobileTitle'  mobile version of class which echoes TITLE - Constantine -->

<?php define('TITLE', 'Register here!'); ?>
<!--Page Meta - Constantine -->
<?php include('includes/header.php'); ?>


<div class="row">
    <!-- Registration Box - Constantine-->
    <div class="col-md-6 col-md-offset-3 box">


        <form id="registrationForm" name="registrationForm" method="POST" action="infoprocessing.php"><!--action="" To be filled - Constantine-->

            <!-- Reg Title - Constantine-->
            <div class="col-md-12">
                <h2><small>Register here!</small></h2>
            </div>
            <!-- !Reg Title - Constantine-->

            <!--  Row - Constantine-->
            <div class="form group row">

                <div class="col-md-12"><label><input type="text" id="username" name="username" placeholder="Username" class="form-control" required></label><em style="color:red;"> *</em></div>
                <div class="col-md-12"><label><input type="password" id="password" name="password" placeholder="Password (min 8 chars)" class="form-control" required></label><em style="color:red;"> *</em></div>
                <div class="col-md-12"><label><input type="password" id="passwordRepeat" name="passwordRepeat" placeholder="Re-type Password" class="form-control" required></label><em style="color:red;"> *</em></div>
                <div class="col-md-12"><label><input type="text" id="fname" name="fname" placeholder="First Name" class="form-control" required></label><em style="color:red;"> *</em></div>
                <div class="col-md-12"><label><input type="text" id="lname" name="lname" placeholder="Last Name" class="form-control" required></label><em style="color:red;"> *</em></div>
                <div class="col-md-12"><label><input type="email" id="email" name="email" placeholder="E-mail" class="form-control" required></label><em style="color:red;"> *</em></div>
                <div class="col-md-12"><label><input type="text" id="phoneNumber1" name="phoneNumber1" placeholder="Primary Contact Number" class="form-control" required></label><em style="color:red;"> *</em></div>
                <div class="col-md-12"><label><input type="text" id="phoneNumber2" name="phoneNumber2" placeholder="Secondary Contact Number" class="form-control"></label><em style="color:rgba(255,255,255,0.01);"> *</em></div>
                <div class="col-md-12">Fields with<em style="color:red;"> *</em> icon are required</div>
                <div class="col-md-12">Already a member? Login <a href="login.php">here</a>!</div>


            </div>
            <!-- !Name-Surname - Constantine-->


            <!-- Login Button Row - Constantine-->
            <div class="form group col-md-12" style="padding: 2% 0 0 0;">

                <div class="row">
                    <input type="hidden" name="registerform" value="TRUE">
                    <button type="submit" class="btn btn-default" id="registrationButton" name="Register" class="btn-lg btn-default" required> Register </button>
                </div>
            </div>
            <!-- !Login Button Row - Constantine-->

        </form>

    </div>
    <!-- !Registration Box - Constantine -->
</div>

<?php include('includes/footer.php'); ?>


</body>

</html>
