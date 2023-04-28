<?php
	class Admin {
		private $db;
		
		public function __construct(){
			$this->db = new Database;
		}
		
		public function getNextAdminID(){
			$this->db->query("SELECT auto_increment FROM information_schema.TABLES WHERE table_schema = 'vwiws' AND table_name = 'administrators'");
			
			$row = $this->db->single();
			return $row;
		}
		
		public function getAdminById($id){
			$this->db->query("SELECT * FROM administrators WHERE id = :id");
			$this->db->bind(":id", $id);
			
			$row = $this->db->single();
			return $row;
		}
		
		public function usernameChecker($username){
			$this->db->query("SELECT DISTINCT * FROM admin_login WHERE username = :username");
			
			$this->db->bind(":username", $username);
			
			$row = $this->db->single();
			return $row;
		}
		
		public function addAdmin($data){
			$this->db->query("INSERT INTO administrators (fname,lname,position,contactNumber,email,dateOfBirth,streetAddress,city,province,postalCode,createdOn,createdBy) VALUES (:fname,:lname,:position,:contactNumber,:email,:dateOfBirth,:streetAddress,:city,:province,:postalCode,now(),:createdBy)");
			
			if(!isset($data["createdBy"])){
				$data["createdBy"] = "System";
			}
			
			// Bind Values
			$this->db->bind(":fname", $data["fname"]);
			$this->db->bind(":lname", $data["lname"]);
			$this->db->bind(":position", $data["position"]);
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
		
		public function addAdminLogin($data){
			$this->db->query("INSERT INTO admin_login (adminId, username, password, status, remarks, createdOn) VALUES (:custId, :username, :password, 1, 'Newly Added', now())");
			
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
		
		public function updateAdmin($data){
			$this->db->query("UPDATE administrators SET fname = :fname, lname = :lname, contactNumber = :contactNumber, email = :email, dateOfBirth = :dateOfBirth, streetAddress = :streetAddress, city = :city, province = :province, postalCode = :postalCode, updatedOn = now(), updatedBy = :updatedBy WHERE id = :id");
			
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
	}
?>