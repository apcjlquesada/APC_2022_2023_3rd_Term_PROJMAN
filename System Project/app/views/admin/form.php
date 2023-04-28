<?php require APPROOT . "/views/templates/adminHeader.php"; ?>
<div class="container">
    <div class="card card-body bg-light mt-3">
        <h1>
            <?php echo ($data["action"]=="add") ? "Registration" : "Update Information"  ?>
        </h1>
        <p><?php echo ($data["action"]=="add") ? "Input" : "Check" ?> your details below</p>
        <br/>
        <form action="<?php echo URLROOT.($data["action"]=="edit" ? "/admin/profile/updateProfile" : "/admin/login/signup"); ?>" method="post">
            
            <!-------------------- Start - Admin's information ---------------->
            <h3>
                Personal Information:
            </h3>
            <div class="form-group mb-3">
                <label for="id">Admin ID: <sup>*</sup></label>
                <input type="text" name="id" class="form-control form-control-lg" value="<?php echo $data["id"]; ?>" readonly>
                
                <label for="fname">First name: <sup>*</sup></label>
                <input type="text" name="fname" class="form-control form-control-lg <?php echo (isset($data["error"]["fname_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["fname"]; ?>" required>
                <span class="invalid-feedback"><?php echo (isset($data["error"]["fname_err"]) ? $data["error"]["fname_err"] : "") ?></span>
                
                <label for="lname">Last name: <sup>*</sup></label>
                <input type="text" name="lname" class="form-control form-control-lg <?php echo (isset($data["error"]["lname_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["lname"]; ?>" required>
                <span class="invalid-feedback"><?php echo (isset($data["error"]["lname_err"]) ? $data["error"]["lname_err"] : "") ?></span>
                
                <label for="position">Position: <sup>*</sup></label>
                <input type="text" name="position" class="form-control form-control-lg <?php echo (isset($data["error"]["position_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["position"]; ?>" readonly>
                
                <label for="contactNumber">Contact Number: <sup>*</sup></label>
                <input type="tel" name="contactNumber" class="form-control form-control-lg <?php echo (isset($data["error"]["contactNumber_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["contactNumber"]; ?>" placeholder="09121231234 or 0912-123-1234" required>
                <span class="invalid-feedback"><?php echo (isset($data["error"]["contactNumber_err"]) ? $data["error"]["contactNumber_err"] : "") ?></span>
                
                <label for="email">Email: <sup>*</sup></label>
                <input type="email" name="email" class="form-control form-control-lg <?php echo (isset($data["error"]["email_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["email"]; ?>" required>
                <span class="invalid-feedback"><?php echo (isset($data["error"]["email_err"]) ? $data["error"]["email_err"] : "") ?></span>
                
                <label for="dateOfBirth">Date of Birth: <sup>*</sup></label>
                <input type="date" name="dateOfBirth" class="form-control form-control-lg <?php echo (isset($data["error"]["dateOfBirth_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["dateOfBirth"]; ?>" required>
                <span class="invalid-feedback"><?php echo (isset($data["error"]["dateOfBirth_err"]) ? $data["error"]["dateOfBirth_err"] : "") ?></span>
                
                <label for="streetAddress">Street Address: <sup>*</sup></label>
                <input type="text" name="streetAddress" class="form-control form-control-lg <?php echo (isset($data["error"]["streetAddress_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["streetAddress"]; ?>" required>
                <span class="invalid-feedback"><?php echo (isset($data["error"]["streetAddress_err"]) ? $data["error"]["streetAddress_err"] : "") ?></span>
                
                <label for="city">City: <sup>*</sup></label>
                <input type="text" name="city" class="form-control form-control-lg <?php echo (isset($data["error"]["city_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["city"]; ?>" required>
                <span class="invalid-feedback"><?php echo (isset($data["error"]["city_err"]) ? $data["error"]["city_err"] : "") ?></span>
                
                <label for="province">Province: <sup>*</sup></label>
                <input type="text" name="province" class="form-control form-control-lg <?php echo (isset($data["error"]["province_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["province"]; ?>" required>
                <span class="invalid-feedback"><?php echo (isset($data["error"]["province_err"]) ? $data["error"]["province_err"] : "") ?></span>
                
                <label for="postalCode">Postal Code: <sup>*</sup></label>
                <input type="text" name="postalCode" class="form-control form-control-lg <?php echo (isset($data["error"]["postalCode_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["postalCode"]; ?>" required>
                <span class="invalid-feedback"><?php echo (isset($data["error"]["postalCode_err"]) ? $data["error"]["postalCode_err"] : "") ?></span>
                <br/><br/>
            </div>
            <!-------------------- End - Admin's information ---------------->
	
			<?php if($data["action"] == "add"){ ?>
            <!--------------------- Start - Login information --------------------->
            <div class="container">
                <h3>
                    Login Information
                </h3>
                <div class="form-group mb-3">
                    <label for="username">Username: <sup>*</sup></label>
                    <input type="text" name="username" class="form-control form-control-lg <?php echo (isset($data["error"]["username_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["username"]; ?>" required>
                    <span class="invalid-feedback"><?php echo (isset($data["error"]["username_err"]) ? $data["error"]["username_err"] : "") ?></span>
                    <label for="password">Password: <sup>*</sup></label>
                    <input type="password" name="password" class="form-control form-control-lg <?php echo (isset($data["error"]["password_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["password"]; ?>" required>
    <!--                <span class="input-group-text" onclick="password_show_hide();">-->
    <!--                  <i class="fa fa-eye" id="show_eye"></i>-->
    <!--                  <i class="fa fa-eye-slash d-none" id="hide_eye"></i>-->
    <!--                </span>-->
                    <span class="invalid-feedback"><?php echo (isset($data["error"]["password_err"]) ? $data["error"]["password_err"] : "") ?></span>

                    <label for="confirm_password">Confirm Password: <sup>*</sup></label>
                    <input type="password" name="confirm_password" class="form-control form-control-lg <?php echo (isset($data["error"]["confirm_password_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["confirm_password"]; ?>" required>
                    <span class="invalid-feedback"><?php echo (isset($data["error"]["confirm_password_err"]) ? $data["error"]["confirm_password_err"] : "") ?></span>
                </div>
            </div>
            <!--------------------- End - Login information --------------------->
            <?php } ?>
            
            <input type="submit" class="btn btn-success" value="<?php echo ($data["action"] == "add" ? "Register" : "Update" ) ?>">
            <a class="btn btn-primary" href="<?php echo REFERER;?>">
                <i class="fa fa-angle-double-left"></i> Back
            </a>
        </form>
    
    </div>
</div>

<script>
    function password_show_hide() {
    var x = document.getElementById("password");
    var show_eye = document.getElementById("show_eye");
    var hide_eye = document.getElementById("hide_eye");
    hide_eye.classList.remove("d-none");
    if (x.type === "password") {
    x.type = "text";
    show_eye.style.display = "none";
    hide_eye.style.display = "block";
    } else {
    x.type = "password";
    show_eye.style.display = "block";
    hide_eye.style.display = "none";
    }
    }
</script>
<?php require APPROOT . "/views/templates/footer.php"; ?>
