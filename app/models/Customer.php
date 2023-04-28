<?php
    class Customer{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }
	
		public function getNextCustomerID(){
			$this->db->query("SELECT auto_increment FROM information_schema.TABLES WHERE table_schema = 'vwiws' AND table_name = 'customers'");
		
			$row = $this->db->single();
			return $row;
		}

        public function getCustomers(){
            $this->db->query("SELECT * FROM customers");

            $results = $this->db->resultSet();
            return $results;
        }

        public function getCustomerById($id){
            $this->db->query("SELECT * FROM customers WHERE id = :id");
            $this->db->bind(":id", $id);

            $row = $this->db->single();
            return $row;
        }
		
		public function usernameChecker($username){
			$this->db->query("SELECT DISTINCT * FROM cust_login WHERE username = :username");
			
			$this->db->bind(":username", $username);
			
			$row = $this->db->single();
			return $row;
		}

        public function addCustomer($data){
            $this->db->query("INSERT INTO customers (fname,lname,contactNumber,email,dateOfBirth,streetAddress,city,province,postalCode,createdOn,createdBy) VALUES (:fname,:lname,:contactNumber,:email,:dateOfBirth,:streetAddress,:city,:province,:postalCode,now(),:createdBy)");
	
			if(!isset($data["createdBy"])){
				$data["createdBy"] = "System";
			}
			
            // Bind Values
            $this->db->bind(":fname", $data["fname"]);
            $this->db->bind(":lname", $data["lname"]);
            $this->db->bind(":contactNumber", $data["contactNumber"]);
            $this->db->bind(":email", $data["email"]);
			$this->db->bind(":dateOfBirth", $data["dateOfBirth"]);
            $this->db->bind(":streetAddress", $data["streetAddress"]);
            $this->db->bind(":city", $data["city"]);
            $this->db->bind(":province", $data["province"]);
            $this->db->bind(":postalCode", $data["postalCode"]);
			$this->db->bind(":createdBy", $data["createdBy"]);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }
		
		public function addCustomerLogin($data){
			$this->db->query("INSERT INTO cust_login (custId, username, password, status, remarks, createdOn) VALUES (:custId, :username, :password, 1, 'Newly Added', now())");
			
			// Bind Values
			$this->db->bind(":custId", $data["id"]);
			$this->db->bind(":username", $data["username"]);
			$this->db->bind(":password", $data["hashed_password"]);
			
			// Execute
			if($this->db->execute()){
				return true;
			} else {
				return false;
			}
		}

        public function updateCustomer($data){
            $this->db->query("UPDATE customers SET fname = :fname, lname = :lname, contactNumber = :contactNumber, email = :email, dateOfBirth = :dateOfBirth, streetAddress = :streetAddress, city = :city, province = :province, postalCode = :postalCode, updatedOn = now(), updatedBy = :updatedBy WHERE id = :id");
			
			if(!isset($data["updatedBy"])){
				$data["updatedBy"] = "System";
			}
			
            // Bind Values
            $this->db->bind(":id", $data["id"]);
            $this->db->bind(":fname", $data["fname"]);
            $this->db->bind(":lname", $data["lname"]);
            $this->db->bind(":contactNumber", $data["contactNumber"]);
            $this->db->bind(":email", $data["email"]);
			$this->db->bind(":dateOfBirth", $data["dateOfBirth"]);
            $this->db->bind(":streetAddress", $data["streetAddress"]);
            $this->db->bind(":city", $data["city"]);
            $this->db->bind(":province", $data["province"]);
            $this->db->bind(":postalCode", $data["postalCode"]);
			$this->db->bind(":updatedBy", $data["updatedBy"]);
			
            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }
		
		public function deleteCustomer($id){
			$this->db->query("DELETE FROM customers WHERE id = :id");
			// Bind Values
			$this->db->bind(":id", $id);
		
			// Execute
			if($this->db->execute()){
				return true;
			} else {
				return false;
			}
		}
    }
