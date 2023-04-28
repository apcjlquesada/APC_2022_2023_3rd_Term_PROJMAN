<?php

    class Pages extends Controller {
        public function __construct(){
			$this->productModel = $this->model("Product");
        }

        public function index(){
			$featuredProducts = $this->productModel->getFeaturedProducts();
            $data = [
                "title" => "Featured Products",
				"featuredProducts" => $featuredProducts
            ];
            $this->view("pages/index", $data);
        }

        public function forum(){
            $data = [
                "title" => "FORUM",
                "heading" => "THIS PAGE IS UNDER CONSTRUCTION"
            ];
            $this->view("pages/forum", $data);
        }

        public function faq(){
            $data = [
                "title" => "FREQUENTLY ASKED QUESTIONS",
				"questions" => [
					1 => ["What other services do you offer?" => "Installation and estimation of aluminum products, roofing, and grills."],
					2 => ["What other products do you offer?" => "Door Jamb, Roll up, Trusses, Grills, Poly Carbonate and etc."],
					3 => ["Do you delivery? How much is the delivery fee?" => "Yes. Lalamove rate."],
					4 => ["Do you accept customized order?" => "Yes. Please feel free to contact us. Our details are in the About Us section"],
					5 => ["What are your mode of payment?" => "Cod, Gcash, and Bank Transfer."]
				]
            ];
            $this->view("pages/faq", $data);
        }

        public function about(){
            $data = [
                "title" => "ABOUT US",
                "heading" => "This is a heading",
                "content" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
            ];
            $this->view("pages/about", $data);
        }
    }