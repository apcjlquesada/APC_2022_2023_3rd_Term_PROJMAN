<?php
    class Products extends Controller {
        public function __construct(){
            $this->productModel = $this->model("Product");
        }

        public function index(){
			$categories = $this->productModel->getCategories();
			$colors = $this->productModel->getColors();
			$priceRange = $this->productModel->getPriceRange();
			$activeProducts = $this->productModel->getActiveProducts();

            $data = [
                "activeProducts" => $activeProducts,
				"categories" => $categories,
				"colors" => $colors,
				"price_range" => $priceRange
            ];
			
			$category = $data["categories"];
			
            $this->view("products/index", $data);
        }

        public function show($id){
			$product = $this->productModel->getProductById($id);
			$productVars = $this->productModel->getVarProductByProductId($id);
            $data = [
				"product" => $product,
				"productVars" => $productVars
            ];
            $this->view("products/show", $data);
        }
    }
