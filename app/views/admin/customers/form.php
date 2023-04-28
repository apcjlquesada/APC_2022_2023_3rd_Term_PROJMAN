<?php require APPROOT . "/views/templates/adminHeader.php"; ?>

<div class="card card-body bg-light mt-3">
	<h1>
		<?php echo ($data["action"]=="add") ? "Add Customer" : "Update Customer's Information"  ?>
	</h1>
	<p>Input the customer's details by using the form below</p>
	<form action="<?php echo URLROOT ."/admin/customers/".($data["action"]=="edit" ? "edit/".$data["id"] : "add"); ?>" method="post">
		<div class="form-group mb-3">
            <label for="id">Customer's ID: <sup>*</sup></label>
            <input type="text" name="id" class="form-control form-control-lg" value="<?php echo $data["id"]; ?>" readonly>

            <label for="fname">First name: <sup>*</sup></label>
            <input type="text" name="fname" class="form-control form-control-lg <?php echo (isset($data["error"]["fname_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["fname"]; ?>" required>
            <span class="invalid-feedback"><?php echo (isset($data["error"]["fname_err"]) ? $data["error"]["fname_err"] : "") ?></span>

            <label for="lname">Last name: <sup>*</sup></label>
            <input type="text" name="lname" class="form-control form-control-lg <?php echo (isset($data["error"]["lname_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["lname"]; ?>" required>
            <span class="invalid-feedback"><?php echo (isset($data["error"]["lname_err"]) ? $data["error"]["lname_err"] : "") ?></span>

            <label for="contactNumber">Contact Number: <sup>*</sup></label>
            <input type="tel" name="contactNumber" class="form-control form-control-lg <?php echo (isset($data["error"]["contactNumber_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["contactNumber"]; ?>" placeholder="09121231234 or 0912-123-1234" required >
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
		</div>
		<input type="submit" class="btn btn-success" value="Submit">
		<a class="btn btn-primary" href="<?php echo REFERER;?>">
			<i class="fa fa-angle-double-left"></i> Back
		</a>
	</form>
</div>

<?php require APPROOT . "/views/templates/footer.php"; ?>
