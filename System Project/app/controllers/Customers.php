<?php
	class Customers extends Controller {
		public function __construct() {
			$this->customerModel = $this->model("Customer");
			$this->transactionModel = $this->model("Transaction");
		}
		
		public function index(){
			 $this->login();
		}
		
		public function	profile() {
			if (!isset($_SESSION["user_info"]) or !$_SESSION["login"]) {
				flash("message", "Please login in order to use that feature!", "alert alert-danger");
				redirect("customers");
			} else {
				$totalPrice = $this->transactionModel->getAllPricesForPayment();
				$forPaymentOrders = $this->transactionModel->getActiveForPaymentOrderProducts();
				$forShippingOrders = $this->transactionModel->getActiveForShippingOrderProducts();
				$completedOrders = $this->transactionModel->getCompletedOrderProducts();
				$data = [
					"title" => "Profile: ",
					"user_info" => $_SESSION["user_info"],
					"forPaymentOrders" => $forPaymentOrders,
					"forShippingOrders" => $forShippingOrders,
					"completedOrders" => $completedOrders,
					"totalPrice" => $totalPrice
				];
				
				$this->view("customers/profile", $data);
			}
		}
		public function login(){
			if(isset($_SESSION["user_info"])) {
				if($_SESSION["login"]){
					redirect("index");
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
					$login_result = $this->customerModel->usernameChecker($data["username"]);
					
					if(empty($login_result)) {
						flash("message", "Cannot find username! Please check.", "alert alert-danger");
						redirectCurrent();
					} elseif (!password_verify($data["password"], $login_result->password)) {
						flash("message", "Incorrect password! Please try again", "alert alert-danger");
						redirectCurrent();
					} elseif (password_verify($data["password"], $login_result->password)) {
						flash("message", "You are now logged in!");
						$_SESSION["login"] = "1";
						$_SESSION["user_info"] = $this->customerModel->getCustomerById($login_result->custId);
						
						redirect("index");
					} else {
						flash("message", "Something went wrong! Please see support!", "alert alert-danger");
						redirectCurrent();
					}
				} else {
					//Load view with errors
					$this->view("customers/login", $data);
				}
			} else {
				$data = [
					"username" => "",
					"password" => ""
				];
				$this->view("customers/login", $data);
			}
		}
		
		public function logout(){
			redirect("index");
			session_destroy();
			session_start();
			exit;
		}
		
		public function signup(){
			$nextID = $this->customerModel->getNextCustomerID()->auto_increment;
			if($_SERVER["REQUEST_METHOD"] == "POST"){
				// Sanitize POST Array
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				
				$data = [
					"action" => "add",
					"createdBy" => "Customer",
					"error" => [],
					
					// for customer's information
					"id" => $nextID,
					"fname" => trim($_POST["fname"]),
					"lname" => trim($_POST["lname"]),
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
				
				// Validation - customer information
				if (empty($data["fname"])) {
					$data["error"]["fname_err"] = "Please enter first name!";
				}
				if (empty($data["lname"])) {
					$data["error"]["lname_err"] = "Please enter last name!";
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
				} elseif ($this->customerModel->usernameChecker($data["username"])){
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
					
					// add customer and login data
					if ($this->customerModel->addCustomer($data) AND $this->customerModel->addCustomerLogin($data)) {
						flash("message", "You are now registered! Thank you!");
						redirect("customers/login");
					} else {
						die("Something went wrong");
					}
				} else {
					//Load view with errors
					$this->view("customers/form", $data);
				}
				
			} else {
				$data = [
					"action" => "add",
					"id" => $nextID,
					"fname" => "",
					"lname" => "",
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
				$this->view("customers/form", $data);
			}
		}
		
		public function updateProfile(){
			if(!isset($_SESSION["user_info"])) {
				if(!$_SESSION["login"]){
					redirect("index");
				}
			}
			
			if($_SERVER["REQUEST_METHOD"] == "POST"){
				// Sanitize POST Array
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				
				$data = [
					"action" => "edit",
					"updatedBy" => "Customer",
					"error" => [],
					
					// for customer's information
					"id" => $_SESSION["user_info"]->id,
					"fname" => trim($_POST["fname"]),
					"lname" => trim($_POST["lname"]),
					"contactNumber" => trim(preg_replace("/\D+/", "",$_POST["contactNumber"])),
					"email" => trim($_POST["email"]),
					"dateOfBirth" => trim($_POST["dateOfBirth"]),
					"streetAddress" => trim($_POST["streetAddress"]),
					"city" => trim($_POST["city"]),
					"province" => trim($_POST["province"]),
					"postalCode" => trim($_POST["postalCode"])
				];
				
				// Validation - customer information
				if (empty($data["fname"])) {
					$data["error"]["fname_err"] = "Please enter first name!";
				}
				if (empty($data["lname"])) {
					$data["error"]["lname_err"] = "Please enter last name!";
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
				
				// Make sure there are no errors
				if (empty($data["error"])) {
					
					// update customer data
					if ($this->customerModel->updateCustomer($data)) {
						// Refresh _SESSION["user_info"] variable
						$_SESSION["user_info"] = $this->customerModel->getCustomerById($data["id"]);
						
						flash("message", "Thank you for updating your profile!");
						redirect("customers/profile");
					} else {
						die("Something went wrong");
					}
				} else {
					//Load view with errors
					$this->view("customers/form", $data);
				}
				
			} else {
				$data = [
					"action" => "edit",
					"id" => $_SESSION["user_info"]->id,
					"fname" => $_SESSION["user_info"]->fname,
					"lname" => $_SESSION["user_info"]->lname,
					"contactNumber" => $_SESSION["user_info"]->contactNumber,
					"email" => $_SESSION["user_info"]->email,
					"dateOfBirth" => $_SESSION["user_info"]->dateOfBirth,
					"streetAddress" => $_SESSION["user_info"]->streetAddress,
					"city" => $_SESSION["user_info"]->city,
					"province" => $_SESSION["user_info"]->province,
					"postalCode" => $_SESSION["user_info"]->postalCode
				];
				$this->view("customers/form", $data);
			}
		}
	}
?>
