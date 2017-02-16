        <form id="newCustomer" name="newCustomer" method="POST" action="functions/adminActionsProccessing.php">

            <!-- Reg Title - Constantine-->
            <div class="col-md-12">
                <h4>New Customer</h4>
            </div>
            <!-- !Reg Title - Constantine-->

            <div class="form group row">

                <div class="col-md-6"><label><input type="text" id="username" name="username" placeholder="Username" class="form-control" required></label><em style="color:red;"> *</em></div>
                <div class="col-md-6"><label><input type="email" id="email" name="email" placeholder="E-mail" class="form-control" required></label><em style="color:red;"> *</em></div>
                <div class="col-md-6"><label><input type="password" id="password" name="password" placeholder="Password (min 8 chars)" class="form-control" required></label><em style="color:red;"> *</em></div>
                <div class="col-md-6"><label><input type="password" id="passwordRepeat" name="passwordRepeat" placeholder="Re-type Password" class="form-control" required></label><em style="color:red;"> *</em></div>
                <div class="col-md-6"><label><input type="text" id="fname" name="fname" placeholder="First Name" class="form-control" required></label><em style="color:red;"> *</em></div>
                <div class="col-md-6"><label><input type="text" id="lname" name="lname" placeholder="Last Name" class="form-control" required></label><em style="color:red;"> *</em></div>
                
                <div class="col-md-6"><label><input type="text" id="phoneNumber1" name="phoneNumber1" placeholder="Primary Contact Number" class="form-control" required></label><em style="color:red;"> *</em></div>
                <div class="col-md-6"><label><input type="text" id="phoneNumber2" name="phoneNumber2" placeholder="Secondary Contact Number" class="form-control"></label><em style="color:rgba(255,255,255,0.01);"> *</em></div>
                <div class="col-md-6">Fields with<em style="color:red;"> *</em> icon are required</div>


            </div>


            <!-- Login Button Row - Constantine-->
            <div class="form group col-md-12" style="padding: 2% 0 0 0;">

                <div class="row">
                    <input type="hidden" name="newCustomer" value="TRUE">
                    <button type="submit" class="btn btn-default" id="newCustomerButton" name="newCustomer" class="btn-lg btn-default" required> Create Customer </button>
                </div>
            </div>
            <!-- !Login Button Row - Constantine-->

        </form>