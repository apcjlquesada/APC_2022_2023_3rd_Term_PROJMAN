<?php require APPROOT . '/views/templates/header.php'; ?>
	<div class="row justify-content-center" style="height: 100%">
		<div class="card p-3 border col-4 align-middle">
			<div class="card-title">
				<h4 class="text-center">Login</h4>
			</div>
			<div class="card-body">
				<form method="post" action="#">
                    <label for="username">User Name: <sup>*</sup></label>
                    <input type="text" name="username" class="form-control form-control-lg" value="" required>
                    <span class="invalid-feedback"><?php echo (isset($data["error"]["username_err"]) ? $data["error"]["username_err"] : "") ?></span>
                    
                    <label for="password">Password: <sup>*</sup></label>
                    <input type="password" name="password" class="form-control form-control-lg" value="" required>
                    <span class="invalid-feedback"><?php echo (isset($data["error"]["password"]) ? $data["error"]["password_err"] : "") ?></span>

                    <span class="invalid-feedback"><?php echo (isset($data["error"]["login_err"]) ? $data["error"]["login_err"] : "") ?></span>
                    <br/>
					<div class="d-flex justify-content-center">
						<input class="btn btn-primary px-5" name="submit" type="submit" id="submit" value="Login">
					</div><br/>
					<p>New User? <a class="btn btn-success" href="<?php echo URLROOT."/customers/signup" ?>">Register Here</a></p>
				</form>
			</div>
		</div>
	</div>

<?php require APPROOT . '/views/templates/footer.php'; ?>
