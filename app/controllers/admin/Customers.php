<?php
    class Customers extends Controller {
        public function __construct(){
            $this->customerModel = $this->model("Customer");
        }

        public function index(){
            // Get all customers
            $customers = $this->customerModel->getCustomers();

            $data = [
                "customers" => $customers
            ];

            $this->view("admin/customers/index", $data);
        }
		
		public function show($id){
			$customer = $this->customerModel->getCustomerById($id);
			$data = [
				"customer" => $customer
			];
		
			$this->view("admin/customers/show", $data);
		}

        public function add(){
			$nextID = $this->customerModel->getNextCustomerID()->auto_increment;
            if($_SERVER["REQUEST_METHOD"] == "POST") {

                // Sanitize POST Array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
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
                    "error" => [],
					"action" => "add"
                ];

                // Validation
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
                    // if validated
                    if ($this->customerModel->addCustomer($data)) {
                        flash("message", "Customer has been added!");
                        redirect("admin/customers");
                    } else {
                        die("Something went wrong");
                    }
                } else {
                    //Load view with errors
                    $this->view("admin/customers/form", $data);
                }
            } else {
                $data = [
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
					"action" => "add"
                ];
                $this->view("admin/customers/form", $data);
            };
        }

        public function edit($id){
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                // Sanitize POST Array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    "id" => $id,
                    "fname" => trim($_POST["fname"]),
                    "lname" => trim($_POST["lname"]),
                    "contactNumber" => trim(preg_replace("/\D+/", "",$_POST["contactNumber"])),
                    "email" => trim($_POST["email"]),
					"dateOfBirth" => trim($_POST["dateOfBirth"]),
                    "streetAddress" => trim($_POST["streetAddress"]),
                    "city" => trim($_POST["city"]),
                    "province" => trim($_POST["province"]),
                    "postalCode" => trim($_POST["postalCode"]),
                    "error" => [],
					"action" => "edit"
                ];

                // Validation
                if(empty($data["fname"])){
                    $data["error"]["fname_err"] = "Please enter first name!";
                }
                if(empty($data["lname"])){
                    $data["error"]["lname_err"] = "Please enter last name!";
                }
                if(empty($data["contactNumber"])){
                    $data["error"]["contactNumber_err"] = "Please enter contact number!";
                }
                if(empty($data["email"])){
                    $data["error"]["email_err"] = "Please enter email!";
                }
				if (empty($data["dateOfBirth"])) {
					$data["error"]["dateOfBirth"] = "Please enter Date of Birth!";
				}
                if(empty($data["streetAddress"])){
                    $data["error"]["streetAddress_err"] = "Please enter street address!";
                }
                if(empty($data["city"])){
                    $data["error"]["city_err"] = "Please enter city!";
                }
                if(empty($data["province"])){
                    $data["error"]["province_err"] = "Please enter province!";
                }
                if(empty($data["postalCode"])){
                    $data["error"]["postalCode_err"] = "Please enter postal code!";
                }

                // Make sure no errors
                if(empty($data["error"])){
                    // if validated
                    if($this->customerModel->updateCustomer($data)){
                        flash("message","Customer's details has been updated");
                        redirect("admin/customers/show/".$data["id"]);
                    } else {
                        die("Something went wrong");
                    }
                } else {
                    //Load view with errors
                    $this->view("admin/customers/form", $data);
                }
            } else {
                // Get existing data from model
                $customer = $this->customerModel->getCustomerById($id);
                $data = [
                    "id" => $customer->id,
                    "fname" => $customer->fname,
                    "lname" => $customer->lname,
                    "contactNumber" => $customer->contactNumber,
                    "email" => $customer->email,
					"dateOfBirth" => $customer->dateOfBirth,
                    "streetAddress" => $customer->streetAddress,
                    "city" => $customer->city,
                    "province" => $customer->province,
                    "postalCode" => $customer->postalCode,
					"action" => "edit"
                ];
                $this->view("admin/customers/form", $data);
            };
        }

        public function delete($id){
            if($_SERVER["REQUEST_METHOD"] == "POST"){
				// Sanitize POST Array
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				
                if($this->customerModel->deleteCustomer($id)){
                    flash("message", "Customer's Profile has been removed!");
                    redirect("admin/customers");
                } else {
                    die("Something went wrong!");
                }
            } else {
                redirect("admin/customers");
            }
        }
    }