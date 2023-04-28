<?php
	class Dashboard extends Controller {
		public function __construct(){
			if(!isset($_SESSION["user_info"]) OR !$_SESSION["login"]) {
				flash("message", "Please login in order to use that feature!", "alert alert-danger");
				redirectCurrent();
			} else {
				$this->customerModel = $this->model("Customer");
				$this->productModel = $this->model("Product");
				$this->transactionModel = $this->model("Transaction");
				
				if(!$this->transactionModel->transactionChecker()){
					$this->transactionModel->createTransaction();
				}
			}
		}
		
		public function index(){
			$forPaymentTransactions = $this->transactionModel->getPendingTransactionForPayment();
			$forShippingTransactions = $this->transactionModel->getPendingTransactionForShipping();
			
			$data = [
				"forPaymentTransactions" => $forPaymentTransactions,
				"forShippingTransactions" => $forShippingTransactions,
				"orders" => []
			];
			$this->view("admin/dashboard", $data);
		}
		
		public function markAsPaid($id){
			if($_SERVER["REQUEST_METHOD"] == "POST") {
				$data = [
					"updatedBy" => $_SESSION["admin_info"]->fname,
					"transactionId" => $id
				];
				
				if($this->transactionModel->markTransactionToShipping($data)){
					flash("message", "The Order has been marked as For Shipping!");
					redirectCurrent();
				} else {
					die("Something went wrong!");
				}
			}
		}
		
		public function completeOrder($id){
			if($_SERVER["REQUEST_METHOD"] == "POST") {
				$data = [
					"updatedBy" => $_SESSION["admin_info"]->fname,
					"transactionId" => $id
				];
				
				if($this->transactionModel->markTransactionAsComplete($data)){
					flash("message", "The Order has been marked as Complete!");
					redirectCurrent();
				} else {
					die("Something went wrong!");
				}
			}
		}
	}
?>