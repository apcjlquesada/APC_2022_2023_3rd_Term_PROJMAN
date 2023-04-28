<?php
    class Product {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }
	
		/*************************** Getters - Start *****************************/
		/**************** based on Products table  - Start *****************/
		public function getNextProductID(){
			$this->db->query("SELECT auto_increment FROM information_schema.TABLES WHERE table_schema = 'vwiws' AND table_name = 'products'");
		
			$row = $this->db->single();
			return $row;
		}
	
		public function getProductById($id){
			$this->db->query("SELECT * FROM products WHERE id = :id");
			$this->db->bind(":id", $id);
		
			$row = $this->db->single();
			return $row;
		}
		
		public function getProductsCheckVars(){
			$this->db->query(
				"SELECT p.id as id, product_name, category, p.img, details, active, var.id as varId
					FROM products p
					LEFT JOIN product_var var ON p.id = var.productId
					GROUP BY p.id");
			
			$results = $this->db->resultSet();
			return $results;
		}
	
		public function getActiveProductsCheckVars(){
			$this->db->query(
				"SELECT p.id as id, product_name, category, p.img, details, active, var.id as varId
					FROM products p
					LEFT JOIN product_var var ON p.id = var.productId
					WHERE active = 1 GROUP BY p.id");
		
			$results = $this->db->resultSet();
			return $results;
		}
	
		public function getArchivedProductsCheckVars(){
			$this->db->query(
				"SELECT p.id as id, product_name, category, p.img, details, active, var.id as varId
					FROM products p
					LEFT JOIN product_var var ON p.id = var.productId
					WHERE active = 0 GROUP BY p.id");
		
			$results = $this->db->resultSet();
			return $results;
		}
	
		public function getProductsCheckVarsById($id){
			$this->db->query(
				"SELECT p.id as id, product_name, category, p.img, details, active, var.id as varId
					FROM products p
					LEFT JOIN product_var var ON p.id = var.productId
					WHERE p.id = :id GROUP BY p.id");
			
			$this->db->bind(":id", $id);
		
			$results = $this->db->single();
			return $results;
		}
		
		public function getActiveProductsAndVarFilters($category = null, $color = null, $price_range = null){
			$category = is_null($category) ? "" : " AND category = '".$category."'";
			$color = is_null($color) ? "" : " AND color = '".$color."'";
			$price_range = is_null($price_range) ? "" : " AND price_range = '".$price_range."'";
			$WHERECLAUSE = $category.$color.$price_range;
			
			$this->db->query(
				"SELECT p.id, p.img, p.product_name, p.details
					FROM products p
					LEFT JOIN product_var v ON p.id = v.productId
					WHERE active = 1 $WHERECLAUSE");
			
			$results = $this->db->resultSet();
			return $results;
		}
		/**************** based on Products table  - End *****************/
	
		/**************** based on Var table  - Start *****************/
		public function getNextVarID(){
			$this->db->query("SELECT auto_increment FROM information_schema.TABLES WHERE table_schema = 'vwiws' AND table_name = 'product_var'");
		
			$row = $this->db->single();
			return $row;
		}
		
		public function getActiveProducts(){
			$this->db->query(
				"SELECT v.id as varId, p.id as productId, v.color, v.size, v.stock, v.price, p.img as productImg, p.category, p.details, p.product_name, v.img as varImg
					FROM product_var v
					LEFT JOIN products p ON v.productId = p.id
					WHERE active = 1"
			);
		
			$results = $this->db->resultSet();
			return $results;
		}
	
		public function getFeaturedProducts(){
			$this->db->query(
				"SELECT v.id as varId, p.id as productId, v.color, v.size, v.stock, v.price, p.img as productImg, p.category, p.details, p.product_name, v.img as varImg
					FROM product_var v
					LEFT JOIN products p ON v.productId = p.id
					WHERE featured = 1");
		
			$results = $this->db->resultSet();
			return $results;
		}
		
		public function getVarProductById($id){
			$this->db->query("SELECT var.id as id, p.product_name as product_name, productId, color, size, p.img as img, stock, price, var.img as varImg, featured
					FROM product_var var
					LEFT JOIN products p ON var.productId = p.id
					WHERE var.id = :id");
			$this->db->bind(":id", $id);
		
			$row = $this->db->single();
			return $row;
		}
	
		public function getVarProductByProductId($id){
			$this->db->query(
				"SELECT var.id as id, p.product_name as product_name, productId, color, size, p.img as img, stock, price, var.img as varImg, featured
					FROM product_var var
					LEFT JOIN products p ON var.productId = p.id
					WHERE p.id = :id");
			$this->db->bind(":id", $id);
		
			$results = $this->db->resultSet();
			return $results;
		}
		/**************** based on Var table  - End *****************/
		/*************************** Getters - End *****************************/

		/************************** Add  - Start ******************************/
        public function addProduct($data){
            $this->db->query("INSERT INTO products (product_name,category,img,details,createdOn,createdBy) VALUE (:product_name,:category,:img,:details,now(),'System')");
			
			// Bind Values
			$this->db->bind(":product_name",$data["product_name"]);
			$this->db->bind(":category", $data["category"]);
			$this->db->bind(":img", $data["img"]);
			$this->db->bind(":details", $data["details"]);
	
			// Execute
			if($this->db->execute()){
				return true;
			} else {
				return false;
			}
        }
		
		public function addProductVar($data){
			$this->db->query("INSERT INTO product_var (productId, color, size, stock, price, img, createdOn, createdBy) VALUE (:productId,:color,:size,:stock,:price,:img,now(),'System')");
			
			// Bind Values
			$this->db->bind(":productId", $data["productId"]);
			$this->db->bind(":color", $data["color"]);
			$this->db->bind(":size", $data["size"]);
			$this->db->bind(":stock", $data["stock"]);
			$this->db->bind(":price", $data["price"]);
			$this->db->bind(":img", $data["varImg"]);
			
			// Execute
			if($this->db->execute()){
				return true;
			} else {
				return false;
			}
		}
		/************************** Add  - End ******************************/
	
		/************************** Update  - Start ******************************/
        public function updateProduct($data){
			$this->db->query("UPDATE products SET product_name = :product_name, category = :category, img = :img, details = :details, updatedOn = now(), updatedBy = 'System' WHERE id = :id");
	
			// Bind Values
			$this->db->bind(":id", $data["id"]);
			$this->db->bind(":product_name",$data["product_name"]);
			$this->db->bind(":category", $data["category"]);
			$this->db->bind(":img", $data["img"]);
			$this->db->bind(":details", $data["details"]);
	
			// Execute
			if($this->db->execute()){
				return true;
			} else {
				return false;
			}
        }
	
		public function updateProductVar($data){
			$this->db->query("UPDATE product_var SET color = :color, size = :size, stock = :stock, price = :price, img = :img, updatedOn = now(), updatedBy = 'System' WHERE id = :id");
		
			// Bind Values
			$this->db->bind(":id", $data["id"]);
			$this->db->bind(":color", $data["color"]);
			$this->db->bind(":size", $data["size"]);
			$this->db->bind(":stock", $data["stock"]);
			$this->db->bind(":price", $data["price"]);
			$this->db->bind(":img", $data["varImg"]);
		
			// Execute
			if($this->db->execute()){
				return true;
			} else {
				return false;
			}
		}

        public function archiveProduct($id){
			$this->db->query("UPDATE products p, product_var v SET p.active = 0, v.featured = 0 WHERE p.id = :id AND v.productId = :id");
			// Bind Values
			$this->db->bind(":id", $id);
	
			// Execute
			if($this->db->execute()){
				return true;
			} else {
				return false;
			}
        }
	
		public function enableProduct($id){
			$this->db->query("UPDATE products set active = 1 WHERE id = :id");
			// Bind Values
			$this->db->bind(":id", $id);
		
			// Execute
			if($this->db->execute()){
				return true;
			} else {
				return false;
			}
		}
		
		public function featureProduct($id){
			$this->db->query("UPDATE product_var set featured = 1 WHERE id = :id");
			// Bind Values
			$this->db->bind(":id", $id);
			
			// Execute
			if($this->db->execute()){
				return true;
			} else {
				return false;
			}
		}
	
		public function unFeatureProduct($id){
			$this->db->query("UPDATE product_var set featured = 0 WHERE id = :id");
			// Bind Values
			$this->db->bind(":id", $id);
		
			// Execute
			if($this->db->execute()){
				return true;
			} else {
				return false;
			}
		}
		/************************** Update  - End ******************************/
		
		/************************* For Filters - Start *****************************/
		public function getCategories(){
			$this->db->query("SELECT category FROM products GROUP BY category");
			
			$results = $this->db->resultSet();
			return $results;
		}
	
		public function getColors(){
			$this->db->query("SELECT color FROM product_var GROUP BY color");
		
			$results = $this->db->resultSet();
			return $results;
		}
	
		public function getPriceRange(){
			$this->db->query("SELECT concat(500*floor(price/500), '-', 500*floor(price/500) + 499) AS price_range FROM product_var GROUP BY 1 ORDER BY price");
		
			$results = $this->db->resultSet();
			return $results;
		}
		/************************* For Filters - End *****************************/
		
		public function getPriceRangeByProduct(){
			// This is to show the price range of a product that varies on its variation
			
		}

    }



?>