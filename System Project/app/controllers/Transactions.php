<?php
	class Transactions extends Controller{
		public function __construct() {
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
			$shoppingCart = $this->transactionModel->getActivePendingOrderProducts();
			$totalPrice = $this->transactionModel->getAllPricesPending();
			$data = [
				"shoppingCart" => $shoppingCart,
				"totalPrice" => $totalPrice
			];
			
			$this->view("transactions/index", $data);
			
		}
		
		public function addToCart(){
			if($_SERVER["REQUEST_METHOD"] == "POST") {
				if($this->transactionModel->transactionPendingChecker()){
					flash("message", "You have an active order. Please wait for the active order to be marked as Completed before doing another order.", "alert alert-danger");
					redirectCurrent();
				}
				
				// Sanitize POST Array
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				if(isset($_POST["varId"])){
					// Validation of stocks
					$varProduct = $this->productModel->getVarProductById($_POST["varId"]);
					$transaction = $this->transactionModel->getTransactionPending();
					if($_POST["quantity"] > $varProduct->stock){
						flash("message","Quantity cannot be greater than stocks! Please select within the available stocks", "alert alert-danger");
						redirectCurrent();
					} else {
						$data = [
							"createdBy" => "Customer",
							"productId" => $varProduct->productId,
							"varId" => $varProduct->id,
							"transactionid" => $transaction->id,
							"quantity" => $_POST["quantity"]
						];
						
						// add to cart
						if($this->transactionModel->addToCart($data)){
							flash("message", "The product has been added to cart!");
							redirectCurrent();
						} else {
							die("Something went wrong!");
						}
					}
				} else {
					flash("message","Please select a variety before clicking 'Add To Cart'", "alert alert-danger");
					redirectCurrent();
				}
			} else {
				flash("message", "There seems to be an issue! Please reach out to support!", "alert alert-danger");
				redirectCurrent();
			}
		}
		
		public function checkout(){
			$shoppingCart = $this->transactionModel->getActivePendingOrderProducts();
			$transaction = $this->transactionModel->getTransactionPending();
			$totalPrice = $this->transactionModel->getAllPricesPending();
			
			if($_SERVER["REQUEST_METHOD"] == "POST") {
				// Sanitize POST Array
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				
				$data = [
					//default
					"totalPrice" => $totalPrice,
					"shoppingCart" => $shoppingCart,
					"custId" => $_SESSION["user_info"]->id,
					
					"error" => [],
					"createdBy" => "Customer",
					"updatedBy" => "Customer",
					"shippingAddress" => $_POST["shippingAddress"],
					"shippingMethod" => $_POST["shippingMethod"],
					"paymentMethod" => $_POST["paymentMethod"],
					"amount" => $totalPrice,
					"transactionId" => $transaction->id
				];
				
				//validation
				if (empty($data["shippingAddress"])) {
					$data["error"]["shippingAddress_err"] = "Please enter shipping address!";
				}
				
				// for stocks checking
				foreach ($shoppingCart as $order){
					if($order->quantity > $order->stock){
						flash("message", "Order cannot proceed as a product is short on stock", "alert alert-danger");
						redirectCurrent();
					}
				}
				
				// Make sure there are no errors
				if(empty($data["error"])){
					// proceed with checkout
					if($this->transactionModel->checkoutDelivery($data) && $this->transactionModel->checkoutPayment($data) && $this->transactionModel->checkoutTransactions($data)){
						// update stocks
						foreach ($shoppingCart as $order){
							$newStock = $order->stock - $order->quantity;
							
							$stockData = [
								"id" => $order->varId,
								"newStock" => $newStock
							];
							$this->transactionModel->checkoutVarStockUpdate($stockData);
						}
						
						flash("message", "Thank you! Your order is now submitted!");
						redirect("customers/profile");
					} else {
						die("Something went wrong");
					}
				} else {
					//Load view with errors
					$this->view("transactions/checkout", $data);
				}
				
			} else {
				$data = [
					"totalPrice" => $totalPrice,
					"shoppingCart" => $shoppingCart,
					"transactionId" => $transaction->id,
					"custId" => $_SESSION["user_info"]->id,
					"shippingAddress" => $_SESSION["user_info"]->streetAddress." ".$_SESSION["user_info"]->city." ".$_SESSION["user_info"]->province." ".$_SESSION["user_info"]->postalCode
				];
				$this->view("transactions/checkout", $data);
			}
		}
		
		public function removeFromCart($orderId){
			if($_SERVER["REQUEST_METHOD"] == "POST") {
				// Sanitize POST Array
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				
				if($this->transactionModel->removeOrderProduct($orderId)){
					flash("message", "Product has been removed from shopping cart!");
					redirectCurrent();
				} else {
					die("Something went wrong!");
				}
			} else {
				flash("message", "There seems to be an issue removing the product! Please reach out to support!", "alert alert-danger");
				redirect("transactions/index");
			}
		}
		
		public function cancelOrder($id){
			if($_SERVER["REQUEST_METHOD"] == "POST") {
				$forPaymentOrders = $this->transactionModel->getActiveForPaymentOrderProducts();
				
				// Sanitize POST Array
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				
				$data = [
					"updatedBy" => "Customer",
					"id" => $id
				];
				
				if($this->transactionModel->cancelTransaction($data)){
					foreach ($forPaymentOrders as $order){
						$newStock = $order->stock + $order->quantity;
						$stockData = [
							"id" => $order->varId,
							"newStock" => $newStock
						];
						$this->transactionModel->checkoutVarStockUpdate($stockData);
					}
					
					flash("message", "Order has been cancelled!");
					redirectCurrent();
				} else {
					die("Something went wrong!");
				}
			} else {
				flash("message", "There seems to be an issue removing the product! Please reach out to support!", "alert alert-danger");
				redirect("transactions/index");
			}
		}
	}
?>