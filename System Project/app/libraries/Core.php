<?php
/*
 * App Core Class
 * Creates URL & loads core controller
 * URL FORMAT - /controller/method/params
 */
class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){
//            print_r($this->getUrl());
        $url = $this->getUrl();

        // redirect to homepage of admin
        if(isset($url[0]) && $url[0] == 'admin' && !isset($url[1])){
            $url[1] = 'dashboard'; // To be changed once Dashboard page is created
        }

        // unset if first value is admin and a class in the URL is set
        if(isset($url[0]) && $url[0] == 'admin' && isset($url[1])){
            unset($url[0]);
        }

        // Look in controllers for first value
        if(isset($url[0]) && file_exists('../app/controllers/' . ucwords($url[0]). '.php')){
            // If exists, set as controller
            $this->currentController = ucwords($url[0]);
            // Unset 0 Index
            unset($url[0]);

            // Require the controller
            require_once '../app/controllers/' . $this->currentController . '.php';
        }
        // Look in controller for second value
        elseif (isset($url[1]) && file_exists('../app/controllers/admin/' . ucwords($url[1]). '.php')){
            // If exists, set as controller
            $this->currentController = ucwords($url[1]);
            // Unset 0 Index
            unset($url[1]);

            // Require the controller
            require_once '../app/controllers/admin/' . $this->currentController . '.php';
        } else {
            require_once '../app/controllers/' . $this->currentController . '.php';
        }

        // Instantiate controller class
        $this->currentController = new $this->currentController;

        // Check for second part of url
        if(isset($url[1])){
            // Check to see if method exists in controller
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];

                // unset 1 index
                unset($url[1]);
            }
        }

        // Check for third part of URL
        if(isset($url[2])){
            // Check to see if method exists in controller
            if(method_exists($this->currentController, $url[2])){
                $this->currentMethod = $url[2];

                // unset 2 index
                unset($url[2]);
            }
        }

        // Get params
        $this->params = $url ? array_values($url) : [];
//        print_r($this->params);

        // Call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
