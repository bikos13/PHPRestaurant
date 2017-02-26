<?php
//Including Database Connection function - Constantine
include "functions/dbcon.php";

$roles = array(); //Array to Collect Roles from Database
?>
<form id="newCustomer" name="newUser" method="POST" action="functions/adminActionsProccessing.php">

    <!-- Reg Title - Constantine-->
    <div class="col-md-12">
        <h4>New Customer OR user</h4>
    </div>
    <!-- !Reg Title - Constantine-->
    <?php
    //===========================================================================
    //Collection roles from Database - Constantinos =============================
    //===========================================================================

    $sql = "SELECT * FROM `userlevels`";
    $result = $mysqli->query($sql);
    if ($mysqli->connect_errno) {
        die("Database Connection failed: %s\n" . $mysqli->connect_error);
        exit();
    }

    if ($result->num_rows > 0) {

        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $roles[$row['USERLEVEL_ID']] = $row['LEVEL_NAME'];
        }
    } else {
        $roles['0'] = "NoRoles";
    }
    $mysqli->close();
    // End of Collection roles from Database - Constantinos =====================
    //===========================================================================

    
    ?>

    <div class="form group row">

        <div class="col-md-6"><label><input type="text" id="username" name="username" placeholder="Username" class="form-control" required></label><em style="color:red;"> *</em></div>
        <div class="col-md-6"><label><input type="email" id="email" name="email" placeholder="E-mail" class="form-control" required></label><em style="color:red;"> *</em></div>
        <div class="col-md-6"><label><input type="password" id="password" name="password" placeholder="Password (min 8 chars)" class="form-control" required></label><em style="color:red;"> *</em></div>
        <div class="col-md-6"><label><input type="password" id="passwordRepeat" name="passwordRepeat" placeholder="Re-type Password" class="form-control" required></label><em style="color:red;"> *</em></div>
        <div class="col-md-6"><label><input type="text" id="fname" name="fname" placeholder="First Name" class="form-control" required></label><em style="color:red;"> *</em></div>
        <div class="col-md-6"><label><input type="text" id="lname" name="lname" placeholder="Last Name" class="form-control" required></label><em style="color:red;"> *</em></div>

        <div class="col-md-6"><label><input type="text" id="phoneNumber1" name="phoneNumber1" placeholder="Primary Contact Number" class="form-control" required></label><em style="color:red;"> *</em></div>
        <div class="col-md-6"><label><input type="text" id="phoneNumber2" name="phoneNumber2" placeholder="Secondary Contact Number" class="form-control"></label><em style="color:rgba(255,255,255,0);"> *</em></div>
        <div class="col-md-6"><label><select class="form-control" name="userLevel" style="width:100%;"><?php foreach ($roles as $key => $value) { echo "<option value='$key'>$value</option>";} ?></select></label></div>
        <div class="col-md-6">Fields with<em style="color:red;"> *</em> icon are required</div>


    </div>


    <!-- Login Button Row - Constantine-->
    <div class="form group col-md-12" style="padding: 2% 0 0 0;">

        <div class="row">
            <input type="hidden" name="source" value="usersHandling">
            <input type="hidden" name="action" value="addUser">
            <button type="submit" class="btn btn-default" id="newUser" class="btn-lg btn-default" required> Create User </button>
        </div>
    </div>
</div>
<!-- !Login Button Row - Constantine-->

</form>