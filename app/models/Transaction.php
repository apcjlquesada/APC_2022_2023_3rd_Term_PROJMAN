<?php
	class Transaction {
		private $db;
		
		public function __construct(){
			$this->db = new Database;
		}
		
		/***************** To Create New Transaction *****************/
		public function createTransaction(){
			$this->db->query("INSERT INTO transactions (customerId, createdOn, createdBy) VALUE (:customerId, now(), 'System')");
			
			/****STATUS is only "PENDING", "FOR PAYMENT", "FOR SHIPPING", "COMPLETED", "CANCELLED" ************/
			/*** CREATE NEW TRANSACTION WHEN THERE IS NO ACTIVE TRANSACTION ***/
			
			// Bind Values
			$this->db->bind(":customerId", $_SESSION["user_info"]->id);
			
			// Execute
			if($this->db->execute()){
				return true;
			} else {
				return false;
			}
		}
		
		/*************** To check if there is no active Transaction *************/
		public function transactionChecker(){
			$this->db->query("SELECT 1 FROM transactions WHERE customerId = :customerId AND active = 1");
			
			// Bind Values
			$this->db->bind(":customerId", $_SESSION["user_info"]->id);
			
			$row = $this->db->single();
			return $row;
		}
		
		public function transactionPendingChecker(){
			$this->db->query("SELECT 1 FROM transactions WHERE customerId = :customerId AND active = 1 AND status IN ('FOR PAYMENT','FOR SHIPPING')");
			
			// Bind Values
			$this->db->bind(":customerId", $_SESSION["user_info"]->id);
			
			$row = $this->db->single();
			return $row;
		}
		
		public function addToCart($data){
			$this->db->query("INSERT INTO order_products (productId, product_varId, transactionId, quantity, createdBy, createdOn) VALUE (:productId, :varId, :transactionId, :quantity, :createdBy, now())");
			
			// if createdBy is not specified
			if(!isset($data["createdBy"])){
				$data["createdBy"] = "System";
			}
			
			// Bind Values
			$this->db->bind(":productId", $data["productId"]);
			$this->db->bind(":varId", $data["varId"]);
			$this->db->bind(":transactionId", $data["transactionid"]);
			$this->db->bind(":quantity", $data["quantity"]);
			$this->db->bind(":createdBy", $data["createdBy"]);
			
			// Execute
			if($this->db->execute()){
				return true;
			} else {
				return false;
			}
		}
		
		/**************************** GETTERS ************************/
		public function getTransaction($id){
			$this->db->query("SELECT * FROM transactions WHERE id = :id");
			
			// Bind Values
			$this->db->bind(":id", $id);
			
			$row = $this->db->single();
			return $row;
		}
		
		public function getTransactionPending(){
			$this->db->query("SELECT * FROM transactions WHERE customerId = :customerId AND active = 1 AND status = 'PENDING'");
			
			// Bind Values
			$this->db->bind(":customerId", $_SESSION["user_info"]->id);
			
			$row = $this->db->single();
			return $row;
		}
		
		public function getPendingTransactionForPayment(){
			$this->db->query(
				"SELECT CONCAT(c.fname,' ',c.lname) as name, t.id as transactionId, t.customerId, t.status, t.amount, p.method
				FROM transactions t
				LEFT JOIN customers c ON c.id = t.customerId
				LEFT JOIN payments p ON p.transactionId = t.id
         		WHERE t.active = 1 AND t.status = 'For Payment'");
			
			
			$results = $this->db->resultSet();
			return $results;
		}
		
		public function getPendingTransactionForShipping(){
			$this->db->query(
				"SELECT CONCAT(c.fname,' ',c.lname) as name, t.id as transactionId, t.customerId, t.status, d.method, d.shippingAddress
				FROM transactions t
				LEFT JOIN customers c ON c.id = t.customerId
				LEFT JOIN delivery d ON d.transactionId = t.id
         		WHERE t.active = 1 AND t.status = 'For Shipping'");
			
			
			$results = $this->db->resultSet();
			return $results;
		}
		
		public function getAllPricesPending(){
			$this->db->query(
				"SELECT SUM(var.price) as total
       				FROM order_products op
					LEFT JOIN transactions t ON t.id = op.transactionId
					LEFT JOIN product_var var ON op.product_varId = var.id
					WHERE t.customerId = :customerId AND t.active = 1 AND t.status = 'PENDING'
				");
			
			// Bind Values
			$this->db->bind(":customerId", $_SESSION["user_info"]->id);
			
			$row = $this->db->single()->total;
			return $row;
		}
		
		public function getAllPricesForPayment(){
			$this->db->query(
				"SELECT SUM(var.price) as total
       				FROM order_products op
					LEFT JOIN transactions t ON t.id = op.transactionId
					LEFT JOIN product_var var ON op.product_varId = var.id
					WHERE t.customerId = :customerId AND t.active = 1 AND t.status = 'FOR PAYMENT'
				");
			
			// Bind Values
			$this->db->bind(":customerId", $_SESSION["user_info"]->id);
			
			$row = $this->db->single()->total;
			return $row;
		}
		
		public function getActivePendingOrderProducts(){
			$this->db->query(
				"SELECT t.id as transactionId, p.id as productId, var.id as varId, op.id as orderId, t.status, p.product_name, op.quantity, var.stock, var.color, var.size, var.price, var.img
       				FROM order_products op
					LEFT JOIN transactions t ON t.id = op.transactionId
					LEFT JOIN product_var var ON op.product_varId = var.id
                    LEFT JOIN products p ON p.id = op.productId
					WHERE t.customerId = :customerId AND t.active = 1 AND t.status = 'PENDING'
				");
			
			// Bind Values
			$this->db->bind(":customerId", $_SESSION["user_info"]->id);
			
			$results = $this->db->resultSet();
			return $results;
		}
		
		public function getActiveForPaymentOrderProducts(){
			$this->db->query(
				"SELECT t.id as transactionId, p.id as productId, op.id as orderId, t.status, p.product_name, op.quantity, var.id as varId, var.stock, var.color, var.size, var.price, var.img
       				FROM order_products op
					LEFT JOIN transactions t ON t.id = op.transactionId
					LEFT JOIN product_var var ON op.product_varId = var.id
                    LEFT JOIN products p ON p.id = op.productId
					WHERE t.customerId = :customerId AND t.active = 1 AND t.status = 'FOR PAYMENT'
				");
			
			// Bind Values
			$this->db->bind(":customerId", $_SESSION["user_info"]->id);
			
			$results = $this->db->resultSet();
			return $results;
		}
		
		public function getActiveForPaymentOrderProductsById($id){
			$this->db->query(
				"SELECT t.id as transactionId, p.id as productId, op.id as orderId, t.status, p.product_name, op.quantity, var.id as varId, var.stock, var.color, var.size, var.price, var.img
       				FROM order_products op
					LEFT JOIN transactions t ON t.id = op.transactionId
					LEFT JOIN product_var var ON op.product_varId = var.id
                    LEFT JOIN products p ON p.id = op.productId
					WHERE t.customerId = :customerId AND t.active = 1 AND t.status = 'FOR PAYMENT'
				");
			
			// Bind Values
			$this->db->bind(":customerId", $id);
			
			$results = $this->db->resultSet();
			return $results;
		}
		
		public function getActiveForShippingOrderProducts(){
			$this->db->query(
				"SELECT t.id as transactionId, p.id as productId, op.id as orderId, t.status, p.product_name, op.quantity, var.stock, var.color, var.size, var.price, var.img
       				FROM order_products op
					LEFT JOIN transactions t ON t.id = op.transactionId
					LEFT JOIN product_var var ON op.product_varId = var.id
                    LEFT JOIN products p ON p.id = op.productId
					WHERE t.customerId = :customerId AND t.active = 1 AND t.status = 'FOR SHIPPING'
				");
			
			// Bind Values
			$this->db->bind(":customerId", $_SESSION["user_info"]->id);
			
			$results = $this->db->resultSet();
			return $results;
		}
		
		public function getCompletedOrderProducts(){
			$this->db->query(
				"SELECT t.id as transactionId, p.id as productId, op.id as orderId, t.status, p.product_name, op.quantity, var.stock, var.color, var.size, var.price, var.img
       				FROM order_products op
					LEFT JOIN transactions t ON t.id = op.transactionId
					LEFT JOIN product_var var ON op.product_varId = var.id
                    LEFT JOIN products p ON p.id = op.productId
					WHERE t.customerId = :customerId AND t.active = 0 AND t.status = 'COMPLETED'
				");
			
			// Bind Values
			$this->db->bind(":customerId", $_SESSION["user_info"]->id);
			
			$results = $this->db->resultSet();
			return $results;
		}
		
		/************* Remove ***************/
		public function removeOrderProduct($orderId){
			$this->db->query("DELETE FROM order_products WHERE id = :orderId");
			
			// Bind Values
			$this->db->bind(":orderId", $orderId);
			
			// Execute
			if($this->db->execute()){
				return true;
			} else {
				return false;
			}
		}
		
		public function cancelTransaction($data){
			$this->db->query("UPDATE transactions SET active = 0, status = 'CANCELLED', updatedOn = now(), updatedBy = :updatedBy WHERE id = :transactionId");
			
			// if updatedBy is not specified
			if(!isset($data["updatedBy"])){
				$data["updatedBy"] = "System";
			}
			
			// Bind Values
			$this->db->bind(":updatedBy", $data["updatedBy"]);
			$this->db->bind(":transactionId", $data["id"]);
			
			// Execute
			if($this->db->execute()){
				return true;
			} else {
				return false;
			}
		}
		
		/******** CHECKOUT *************/
		public function checkoutDelivery($data){
			$this->db->query("INSERT INTO delivery (transactionID, method, shippingAddress, createdDate, createdBy) VALUE (:transactionId, :shippingMethod, :shippingAddress, now(), :createdBy)");
			
			// if createdBy is not specified
			if(!isset($data["createdBy"])){
				$data["createdBy"] = "System";
			}
			
			// Bind Values
			$this->db->bind(":transactionId", $data["transactionId"]);
			$this->db->bind(":shippingMethod", $data["shippingMethod"]);
			$this->db->bind(":shippingAddress", $data["shippingAddress"]);
			$this->db->bind(":createdBy", $data["createdBy"]);
			
			// Execute
			if($this->db->execute()){
				return true;
			} else {
				return false;
			}
		}
		
		public function checkoutPayment($data){
			$this->db->query("INSERT INTO payments (transactionId, method, amount) VALUE (:transactionId, :paymentMethod, :amount)");
			
			// Bind Values
			$this->db->bind(":transactionId", $data["transactionId"]);
			$this->db->bind(":paymentMethod", $data["paymentMethod"]);
			$this->db->bind(":amount", $data["amount"]);
			
			// Execute
			if($this->db->execute()){
				return true;
			} else {
				return false;
			}
		}
		
		public function markTransactionToShipping($data){
			$this->db->query("UPDATE transactions SET status = 'FOR SHIPPING', updatedOn = now(), updatedBy = :updatedBy WHERE id = :transactionId");
			
			// if updatedBy is not specified
			if(!isset($data["updatedBy"])){
				$data["updatedBy"] = "System";
			}
			
			// Bind Values
			$this->db->bind(":updatedBy", $data["updatedBy"]);
			$this->db->bind(":transactionId", $data["transactionId"]);
			
			// Execute
			if($this->db->execute()){
				return true;
			} else {
				return false;
			}
		}
		
		public function markTransactionAsComplete($data){
			$this->db->query("UPDATE transactions SET status = 'COMPLETED', active = 0, updatedOn = now(), updatedBy = :updatedBy WHERE id = :transactionId");
			
			// if updatedBy is not specified
			if(!isset($data["updatedBy"])){
				$data["updatedBy"] = "System";
			}
			
			// Bind Values
			$this->db->bind(":updatedBy", $data["updatedBy"]);
			$this->db->bind(":transactionId", $data["transactionId"]);
			
			// Execute
			if($this->db->execute()){
				return true;
			} else {
				return false;
			}
		}
		
		public function checkoutTransactions($data){
			$this->db->query("UPDATE transactions SET status = 'FOR PAYMENT', amount = :amount, updatedOn = now(), updatedBy = :updatedBy WHERE id = :transactionId");
			
			// if updatedBy is not specified
			if(!isset($data["updatedBy"])){
				$data["updatedBy"] = "System";
			}
			
			// Bind Values
			$this->db->bind(":amount", $data["amount"]);
			$this->db->bind(":updatedBy", $data["updatedBy"]);
			$this->db->bind(":transactionId", $data["transactionId"]);
			
			// Execute
			if($this->db->execute()){
				return true;
			} else {
				return false;
			}
		}
		
		public function checkoutVarStockUpdate($data){
			$this->db->query("UPDATE product_var SET stock = :newStock, updatedOn = now(), updatedBy = 'System' WHERE id = :id");
			
			// Bind
			$this->db->bind(":newStock", $data["newStock"]);
			$this->db->bind(":id", $data["id"]);
			
			// Execute
			if($this->db->execute()){
				return true;
			} else {
				return false;
			}
		}
	}
?>