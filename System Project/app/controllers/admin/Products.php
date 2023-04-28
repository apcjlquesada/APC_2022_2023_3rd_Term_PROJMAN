<?php
class Products extends Controller {
    public function __construct(){
        $this->productModel = $this->model("Product");
    }
	
	public function index(){
		$activeProducts = $this->productModel->getActiveProductsCheckVars();
		$archivedProducts = $this->productModel->getArchivedProductsCheckVars();
		$products = $this->productModel->getProductsCheckVars();
		
		$data = [
			"activeProducts" => $activeProducts,
			"archivedProducts" => $archivedProducts,
			"products" => $products
		];
		$this->view("admin/products/index", $data);
	}
	
	public function show($id){
		$product = $this->productModel->getProductById($id);
		$productVars = $this->productModel->getVarProductByProductId($id);
		
		$data = [
			"product" => $product,
			"productVars" => $productVars,
			
			// Variables for adding a variation
			"productId" => trim($id),
			"color" => "",
			"size" => "",
			"stock" => "",
			"price" => "",
			"active" => "",
			"featured" => ""
		];
		$this->view("admin/products/show", $data);
	}
	
	public function add(){
		$nextID = $this->productModel->getNextProductID()->auto_increment;
		
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			// Sanitize POST Array
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				"id" => $nextID,
				"product_name" => trim($_POST["product_name"]),
				"category" => trim($_POST["category"]),
				"details" => trim($_POST["details"]),
				"error" => [],
				"action" => "add"
			];

			// Validation
			if(empty($data["product_name"])){
				$data["error"]["product_name_err"] = "Please enter the product name!";
			}
			if(empty($data["category"])){
				$data["error"]["category_err"] = "Please enter the category!";
			}
			if(empty($data["details"])){
				$data["error"]["details_err"] = "Please enter the product details!";
			}
			
			// image check
			if(empty($_FILES["img"]["name"])){
				$data["img"] = DEFAULTIMAGE;
				$uploadOk = 1;
			} else {
				$uploadOk = 1;
				
				$img_dir = "img/products/";
				$img_file = $img_dir.basename($_FILES["img"]["name"]);
				$imageFileType = strtolower(pathinfo($img_file, PATHINFO_EXTENSION));
				
				$check = getimagesize($_FILES["img"]["tmp_name"]);
				if($check){
					$uploadOk = 1;
				} else {
					$data["error"]["img_err"] = "File is NOT an image.";
					$uploadOk = 0;
				}
				
				// image formats
				if($imageFileType != "jpg" && $imageFileType!= "png" && $imageFileType="jpeg"){
					$data["error"]["img_err"] = "Sorry, please only use jpg, jpeg, or png image.";
					$uploadOk = 0;
				}
				
				$data["img"] = "img_".trim($data["product_name"]," \t\n\r\0\x0B")."_".$nextID.".".$imageFileType;
			}
			
			// Make sure there are no errors
			if (empty($data["error"])) {
				// upload image
				if($uploadOk) {
					$filenameWithDir = $img_dir.$data["img"];
					if (!move_uploaded_file($_FILES["img"]["tmp_name"], $filenameWithDir)) {
						clearstatcache();
						flash("message", "Something went wrong uploading image OR no image has been uploaded.");
					} else {
						clearstatcache();
					}
					
					// if validated
					if ($this->productModel->addProduct($data)) {
						clearstatcache();
						flash("message", "Product has been added!");
						redirect("admin/products");
					} else {
						die("Something went wrong");
					}
				}
				
			} else {
				//Load view with errors
				$this->view("admin/products/form", $data);
			}
		} else {
			$data = [
				"id" => $nextID,
				"product_name" => "",
				"category" => "",
				"details" => "",
				"action" => "add"
			];
			$this->view("admin/products/form", $data);
		};
	}
	
	public function edit($id){
		$product = $this->productModel->getProductById($id);
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			// Sanitize POST Array
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			
			$data = [
				"id" => $id,
				"product_name" => trim($_POST["product_name"]),
				"category" => trim($_POST["category"]),
				"details" => trim($_POST["details"]),
				"error" => [],
				"action" => "edit"
			];
			
			// Validation
			if(empty($data["product_name"])){
				$data["error"]["product_name_err"] = "Please enter the product name!";
			}
			if(empty($data["category"])){
				$data["error"]["category_err"] = "Please enter the category!";
			}
			if(empty($data["details"])){
				$data["error"]["details_err"] = "Please enter the product details!";
			}
			
			// image check if changed
			if(empty($_FILES["img"]["name"])){
				$uploadOk = 0;
				$data["img"] = $product->img;
			} else {
				$uploadOk = 1;
				
				$img_dir = "img/products/";
				$img_file = $img_dir.basename($_FILES["img"]["name"]);
				$imageFileType = strtolower(pathinfo($img_file, PATHINFO_EXTENSION));
				
				$check = getimagesize($_FILES["img"]["tmp_name"]);
				if($check){
					$uploadOk = 1;
				} else {
					$data["error"]["img_err"] = "File is NOT an image.";
					$uploadOk = 0;
				}
				
				// image formats
				if($imageFileType != "jpg" && $imageFileType!= "png" && $imageFileType="jpeg"){
					$data["error"]["img_err"] = "Sorry, please only use jpg, jpeg, or png image.";
					$uploadOk = 0;
				}
				$data["img"] = "img_".trim($data["product_name"]," \t\n\r\0\x0B")."_".$id.".".$imageFileType;
			}
			
			// Make sure there are no errors
			if (empty($data["error"])) {
				// upload image
				if($uploadOk) {
					$filenameWithDir = $img_dir.$data["img"];
					if (!move_uploaded_file($_FILES["img"]["tmp_name"], $filenameWithDir)) {
						flash("message", "Something went wrong uploading image OR no image has been uploaded.");
					}
				}
				// if validated
				if ($this->productModel->updateProduct($data)) {
					clearstatcache();
					flash("message", "Product has been updated!");
					redirect("admin/products/show/".$id);
				} else {
					die("Something went wrong");
				}
			} else {
				//Load view with errors
				$this->view("admin/products/form", $data);
			}
		} else {
			// Get existing data from model
			$data = [
				"id" => $product->id,
				"product_name" => $product->product_name,
				"category" => $product->category,
				"img" => $product->img,
				"details" => $product->details,
				"action" => "edit"
			];
			$this->view("admin/products/form", $data);
		};
	}
	
	public function addVar($productId){
		$product = $this->productModel->getProductById($productId);
		$varNextID = $this->productModel->getNextVarID()->auto_increment;
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			// Sanitize POST Array
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			
			$data = [
				"varNextID" => $varNextID,
				"action" => "add",
				
				// Variables for adding a variation
				"productId" => trim($_POST["productId"]),
				"product_name" => trim($_POST["product_name"]),
				"color" => trim($_POST["color"]),
				"size" => trim($_POST["size"]),
				"stock" => trim($_POST["stock"]),
				"price" => trim($_POST["price"]),
				"error" => []
			];
			
			// Validation
			if(empty($data["color"])){
				$data["error"]["color_err"] = "Please enter the color!";
			}
			if(empty($data["size"])){
				$data["error"]["size_err"] = "Please enter the size";
			}
			if(empty($data["stock"])){
				$data["error"]["stock_err"] = "Please enter how many are the stocks!";
			}
			if(empty($data["price"])){
				$data["error"]["price_err"] = "Please enter the price!";
			}
			
			// image check for Var
			if(empty($_FILES["img"]["name"])){
				$data["varImg"] = DEFAULTIMAGE;
				$uploadOk = 1;
			} else {
				$uploadOk = 1;
				
				$img_dir = "img/products/";
				$img_file = $img_dir.basename($_FILES["img"]["name"]);
				$imageFileType = strtolower(pathinfo($img_file, PATHINFO_EXTENSION));
				
				$check = getimagesize($_FILES["img"]["tmp_name"]);
				if($check){
					$uploadOk = 1;
				} else {
					$data["error"]["img_err"] = "File is NOT an image.";
					$uploadOk = 0;
				}
				
				// image formats
				if($imageFileType != "jpg" && $imageFileType!= "png" && $imageFileType="jpeg"){
					$data["error"]["img_err"] = "Sorry, please only use jpg, jpeg, or png image.";
					$uploadOk = 0;
				}
				
				$data["varImg"] = "img_".trim($data["product_name"]," \t\n\r\0\x0B")."_".$data["productId"]."_var".$varNextID.".".$imageFileType;
			}
			
			// Make sure there are no errors
			if (empty($data["error"])) {
				// upload image
				if($uploadOk) {
					$filenameWithDir = $img_dir . $data["varImg"];
					if (!move_uploaded_file($_FILES["img"]["tmp_name"], $filenameWithDir)) {
						clearstatcache();
						flash("message", "Something went wrong uploading image OR no image has been uploaded.");
					} else {
						clearstatcache();
					}
					
					// if validated
					if ($this->productModel->addProductVar($data)) {
						clearstatcache();
						flash("message", "Product variation has been added!");
						redirect("admin/products/show/".$productId);
					} else {
						die("Something went wrong");
					}
				}
			} else {
				//Load view with errors
				$this->view("admin/products/varForm/", $data);
			}
		} else {
			$data = [
				"action" => "add",
				"productId" => $product->id,
				"product_name" => $product->product_name,
				"color" => "",
				"size" => "",
				"stock" => "",
				"price" => ""
			];
			$this->view("admin/products/varForm", $data);
		}
	}
	
	public function editVar($id){
		$varProduct = $this->productModel->getVarProductById($id);
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			// Sanitize POST Array
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			
			$data = [
				"action" => "edit",
				"id" => $id,
				"productId" => $varProduct->productId,
				"color" => trim($_POST["color"]),
				"size" => trim($_POST["size"]),
				"stock" => trim($_POST["stock"]),
				"price" => trim($_POST["price"]),
				"error" => []
			];
			
			// Validation
			if(empty($data["color"])){
				$data["error"]["color_err"] = "Please enter the color!";
			}
			if(empty($data["size"])){
				$data["error"]["size_err"] = "Please enter the size";
			}
			if(empty($data["stock"])){
				$data["error"]["stock_err"] = "Please enter how many are the stocks!";
			}
			if(empty($data["price"])){
				$data["error"]["price_err"] = "Please enter the price!";
			}
			
			// image check for Var
			if(empty($_FILES["img"]["name"])){
				$uploadOk = 0;
				$data["varImg"] = $varProduct->varImg;
			} else {
				$uploadOk = 1;
				
				$img_dir = "img/products/";
				$img_file = $img_dir.basename($_FILES["img"]["name"]);
				$imageFileType = strtolower(pathinfo($img_file, PATHINFO_EXTENSION));
				
				$check = getimagesize($_FILES["img"]["tmp_name"]);
				if($check){
					$uploadOk = 1;
				} else {
					$data["error"]["img_err"] = "File is NOT an image.";
					$uploadOk = 0;
				}
				
				// image formats
				if($imageFileType != "jpg" && $imageFileType!= "png" && $imageFileType="jpeg"){
					$data["error"]["img_err"] = "Sorry, please only use jpg, jpeg, or png image.";
					$uploadOk = 0;
				}
				
				$data["varImg"] = "img_".trim($varProduct->product_name," \t\n\r\0\x0B")."_".$varProduct->productId."_var".$id.".".$imageFileType;
			}
			
			// Make sure there are no errors
			if (empty($data["error"])) {
				// upload image
				if($uploadOk) {
					$filenameWithDir = $img_dir . $data["varImg"];
					if (!move_uploaded_file($_FILES["img"]["tmp_name"], $filenameWithDir)) {
						flash("message", "Something went wrong uploading image OR no image has been uploaded.");
						clearstatcache();
					} else {
						clearstatcache();
					}
				}
				
				// if validated
				if ($this->productModel->updateProductVar($data)) {
					clearstatcache();
					flash("message", "The variation of the product has been updated!");
					redirect("admin/products/show/".$varProduct->productId);
				} else {
					die("Something went wrong!");
				}
			} else {
				//Load view with errors
				$this->view("admin/products/varForm", $data);
			}
		} else {
			$data = [
				"action" => "edit",
				"id" => $varProduct->id,
				"productId" => $varProduct->productId,
				"product_name" => $varProduct->product_name,
				"color" => $varProduct->color,
				"size" => $varProduct->size,
				"stock" => $varProduct->stock,
				"price" => $varProduct->price,
				"img" => $varProduct->varImg
			];
			$this->view("admin/products/varForm", $data);
		}
	}
	
	public function archive($id){
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			// Sanitize POST Array
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			
			if($this->productModel->archiveProduct($id)){
				flash("message", "The product has been archived!");
				redirectCurrent();
			} else {
				die("Something went wrong!");
			}
		} else {
			flash("message", "There seems to be an issue archiving the product! Please reach out to support!");
			redirect("admin/products");
		}
	}
	
	public function enable($id){
		$check = $this->productModel->getProductsCheckVarsById($id);
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			// Sanitize POST Array
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			
			$data = [
				"check" => $check
			];
			
			if($data["check"]->varId == null){
				flash("message", var_dump($data["check"])."Cannot enable product as no variations found!");
				redirectCurrent();
			} else {
				if($this->productModel->enableProduct($id)){
					flash("message", "The product has been enabled!");
					redirectCurrent();
				} else {
					die("Something went wrong!");
				}
			}
		} else {
			flash("message", "There seems to be an issue activating the product! Please reach out to support!");
			redirect("admin/products");
		}
	}
	
	public function feature($id){
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			// Sanitize POST Array
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			
			if ($this->productModel->featureProduct($id)) {
				flash("message", "The product has been featured!");
				redirectCurrent();
			} else {
				die("Something went wrong!");
			}
		} else {
			flash("message", "There seems to be an issue featuring the product! Please reach out to support!");
			redirect("admin/products");
		}
	}
	
	public function unFeature($id){
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			// Sanitize POST Array
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			
			if ($this->productModel->unFeatureProduct($id)) {
				flash("message", "The product has been unfeatured!");
				redirectCurrent();
			} else {
				die("Something went wrong!");
			}
		} else {
			flash("message", "There seems to be an issue unfeaturing the product! Please reach out to support!");
			redirect("admin/products");
		}
	}


}