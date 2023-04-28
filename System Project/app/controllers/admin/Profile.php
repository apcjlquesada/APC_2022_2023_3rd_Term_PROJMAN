<?php
	class Profile extends Controller {
		public function __construct(){
			if(!isset($_SESSION["admin_info"]) OR !$_SESSION["login"]) {
				flash("message", "Please login in order to use that feature!", "alert alert-danger");
				redirect("admin/login");
			} else {
				$this->adminModel = $this->model("Admin");
			}
		}
		
		public function index(){
			$data = [
				"admin_info" => $_SESSION["admin_info"]
			];
			$this->view("admin/profile", $data);
		}
		
		public function updateProfile(){
			if($_SERVER["REQUEST_METHOD"] == "POST"){
				// Sanitize POST Array
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				
				$data = [
					"action" => "edit",
					"updatedBy" => $_SESSION["admin_info"]->fname." ".$_SESSION["admin_info"]->lname,
					"error" => [],
					
					// for admin's information
					"id" => $_SESSION["admin_info"]->id,
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
				
				// Validation - admin information
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
					
					// update admin data
					if ($this->adminModel->updateAdmin($data)) {
						// Refresh _SESSION["admin_info"] variable
						$_SESSION["admin_info"] = $this->adminModel->getAdminById($data["id"]);
						
						flash("message", "Thank you for updating your profile!");
						redirect("admin/profile");
					} else {
						die("Something went wrong");
					}
				} else {
					//Load view with errors
					$this->view("admin/form", $data);
				}
				
			} else {
				$data = [
					"action" => "edit",
					"id" => $_SESSION["admin_info"]->id,
					"fname" => $_SESSION["admin_info"]->fname,
					"lname" => $_SESSION["admin_info"]->lname,
					"position" => $_SESSION["admin_info"]->position,
					"contactNumber" => $_SESSION["admin_info"]->contactNumber,
					"email" => $_SESSION["admin_info"]->email,
					"dateOfBirth" => $_SESSION["admin_info"]->dateOfBirth,
					"streetAddress" => $_SESSION["admin_info"]->streetAddress,
					"city" => $_SESSION["admin_info"]->city,
					"province" => $_SESSION["admin_info"]->province,
					"postalCode" => $_SESSION["admin_info"]->postalCode
				];
				$this->view("admin/form", $data);
			}
		}
	}
?>