<?php
	class Login extends Controller {
		public function __construct(){
			$this->adminModel = $this->model("Admin");
		}
		
		public function index(){
			$this->login();
		}
		
		public function login(){
			if(isset($_SESSION["admin_info"])) {
				if($_SESSION["admin_login"]){
					redirect("admin/dashboard");
				}
			}
			if($_SERVER["REQUEST_METHOD"] == "POST"){
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				
				$data = [
					"username" => trim($_POST["username"]),
					"password" => trim($_POST["password"]),
					"error" => []
				];
				
				// Validation
				if (empty($data["username"])) {
					$data["error"]["username_err"] = "Please enter username!";
				}
				
				if (empty($data["password"])) {
					$data["error"]["password_err"] = "Please enter password!";
				}
				
				if(empty($data["error"])){
					// Check login
					$login_result = $this->adminModel->usernameChecker($data["username"]);
					
					if(empty($login_result)) {
						flash("message", "Cannot find username! Please check.", "alert alert-danger");
						redirectCurrent();
					} elseif (!password_verify($data["password"], $login_result->password)) {
						flash("message", "Incorrect password! Please try again", "alert alert-danger");
						redirectCurrent();
					} elseif (password_verify($data["password"], $login_result->password)) {
						flash("message", "You are now logged in!");
						$_SESSION["admin_login"] = "1";
						$_SESSION["admin_info"] = $this->adminModel->getAdminById($login_result->adminId);
						
						redirect("admin/dashboard");
					} else {
						flash("message", "Something went wrong! Please see support!", "alert alert-danger");
						redirectCurrent();
					}
				} else {
					//Load view with errors
					$this->view("admin/login", $data);
				}
			} else {
				$data = [
					"username" => "",
					"password" => ""
				];
				$this->view("admin/login", $data);
			}
		}
		
		public function logout(){
			redirect("admin/login/index");
			session_destroy();
			session_start();
			exit;
		}
		
		public function signup(){
			$nextID = $this->adminModel->getNextAdminID()->auto_increment;
			if($_SERVER["REQUEST_METHOD"] == "POST"){
				// Sanitize POST Array
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				
				$data = [
					"action" => "add",
					"createdBy" => "Admin",
					"error" => [],
					
					// for admin's information
					"id" => $nextID,
					"fname" => trim($_POST["fname"]),
					"lname" => trim($_POST["lname"]),
					"position" => "Manager",
					"contactNumber" => trim(preg_replace("/\D+/", "",$_POST["contactNumber"])),
					"email" => trim($_POST["email"]),
					"dateOfBirth" => trim($_POST["dateOfBirth"]),
					"streetAddress" => trim($_POST["streetAddress"]),
					"city" => trim($_POST["city"]),
					"province" => trim($_POST["province"]),
					"postalCode" => trim($_POST["postalCode"]),
					
					// for login
					"username" => trim($_POST["username"]),
					"password" => trim($_POST["password"]),
					"confirm_password" => trim($_POST["confirm_password"])
				];
				
				// Validation - admin information
				if (empty($data["fname"])) {
					$data["error"]["fname_err"] = "Please enter first name!";
				}
				if (empty($data["lname"])) {
					$data["error"]["lname_err"] = "Please enter last name!";
				}
				if (empty($data["position"])) {
					$data["error"]["position_err"] = "Please enter position";
				}
				if (empty($data["contactNumber"])) {
					$data["error"]["contactNumber_err"] = "Please enter contact number!";
				}
				if (empty($data["email"])) {
					$data["error"]["email_err"] = "Please enter email!";
				}
				if (empty($data["dateOfBirth"]) OR $data["dateOfBirth"] == "mm/dd/yyyy") {
					$data["error"]["dateOfBirth_err"] = "Please enter Date of Birth!";
				}
				if (empty($data["streetAddress"])) {
					$data["error"]["streetAddress_err"] = "Please enter street address!";
				}
				if (empty($data["city"])) {
					$data["error"]["city_err"] = "Please enter city!";
				}
				if (empty($data["province"])) {
					$data["error"]["province_err"] = "Please enter province!";
				}
				if (empty($data["postalCode"])) {
					$data["error"]["postalCode_err"] = "Please enter postal code!";
				}
				
				// Validation - login information
				if (empty($data["username"])) {
					$data["error"]["username_err"] = "Please enter username!";
				} elseif ($this->adminModel->usernameChecker($data["username"])){
					$data["error"]["username_err"] = "Username already taken";
				}
				
				if (empty($data["password"])) {
					$data["error"]["password_err"] = "Please enter password!";
				}
				if (empty($data["confirm_password"])) {
					$data["error"]["confirm_password_err"] = "Please enter password!";
				} elseif ($data["confirm_password"] != $data["password"]){
					$data["error"]["confirm_password_err"] = "Does not match the password. Please makes sure that it matches";
				}
				
				// Make sure there are no errors
				if (empty($data["error"])) {
					// hash password
					$data["hashed_password"] = password_hash($data["password"], PASSWORD_DEFAULT);
					
					// add admin and login data
					if ($this->adminModel->addAdmin($data) AND $this->adminModel->addAdminLogin($data)) {
						flash("message", "You are now registered! Thank you!");
						redirect("admin/login");
					} else {
						die("Something went wrong");
					}
				} else {
					//Load view with errors
					$this->view("admin/form", $data);
				}
			} else {
				$data = [
					"action" => "add",
					"id" => $nextID,
					"fname" => "",
					"lname" => "",
					"position" => "",
					"contactNumber" => "",
					"email" => "",
					"dateOfBirth" => "",
					"streetAddress" => "",
					"city" => "",
					"province" => "",
					"postalCode" => "",
					
					// for login
					"username" => "",
					"password" => "",
					"confirm_password" => ""
				];
				$this->view("admin/form", $data);
			}
		}
	}
?>