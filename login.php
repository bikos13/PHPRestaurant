<!--Page Meta - Constantine -->
<!--TITLE Constant is being used for the header <title> tag and also for the 'mobileTitle'  mobile version of class which echoes TITLE - Constantine -->

<?php define('TITLE', 'Login Page'); ?>
<!--Page Meta - Constantine -->
<?php include('includes/header.php'); ?>


<div class="row">
    <!-- Login Box - Constantine-->
    <div class="box col-md-6 col-md-offset-3">



        <form id="login" name="login" method="POST" action="infoprocessing.php"><!--action="" To be filled - Constantine-->

            <!-- Login Title - Constantine-->
            <div class="col-md-12">
                <h2>Login</h2>
            </div>
            <!-- !Login Title - Constantine-->
            
            <!-- Username Row - Constantine-->
            <div class="form group row">

                <div class="col-xs-4"><label><h5>Username</h5></label></div>
                <div class="col-xs-8">
                    <input type="text" id="username" name="username" placeholder="Username" class="form-control"required>
                </div>

            </div>
            <!-- !Username Row - Constantine-->
            
            <!-- Password Row - Constantine-->
            <div class="form group row">

                <div class="col-xs-4"><label><h5>Password</h5></label></div>
                <div class="col-xs-8">
                    <input type="password" id="password" name="password" placeholder="Password" class="form-control" required>
                </div>

            </div>
            <!-- !Password Row - Constantine-->
            
            <!-- Not a member Row - Constantine-->
            <div class="form group row">

                <div class="col-xs-12"> Not a member ? Register <a href="register.php">here</a>!</div>
                

            </div>
            <!-- !Not a member Row - Constantine-->
            
            <!-- Login Button Row - Constantine-->
            <div class="form group col-md-12" style="padding: 2% 0 0 0;">

                <div class="row">
                    <input type="hidden" name="loginform" value="TRUE">
                    <button type="submit" id="loginButton" name="Login" class="btn btn-default" required> Login </button>
                </div>
            </div>
            <!-- !Login Button Row - Constantine-->

        </form>

    </div>
    <!-- !Login Box - Constantine -->

</div>

<?php include('includes/footer.php'); ?>


</body>

</html>
