<?php

class Core{
    /**
     * Framework core class
     * Loads Url and gets controllers and methods
     * Url Format : website/controller/method/params
     */
    
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];


    public function __construct(){
        //Get url

        $url = $this->getUrl();

        //Check if controllers file exists
        if(file_exists(APPROOT . '/controllers/' . ucwords($url[0]) . '.php')){
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }
        //require the controller
        require_once APPROOT . '/controllers/' . $this->currentController . '.php';

        //Instantiate current controller
        $this->currentController = new $this->currentController;

        //Check if method was set and if it exists
        if(isset($url[1])){
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        //Assign Paramaters if they were set
        $this->params = $url ? array_values($url) : [];

        //Load callback function with array of values

        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

    }

    private function getUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
