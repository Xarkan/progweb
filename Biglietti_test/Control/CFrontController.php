<?php


class CFrontController {
    protected $controller;
    protected $finalmethod;
    protected $params;
    
    function __construct() {
        $resource = $_SERVER['REQUEST_URI'];
        $this->controller = 'C'.$resource;
        $method = $_SERVER['REQUEST_METHOD'];
        $this->finalmethod = $method.$resource;
        $this->params = ['REQUEST_URI'];
    }
    
    function run(){
   
        if ( class_exists( $this->controller ) ) {
            if ( method_exists($this->controller, $this->finalmethod ) ) {
                $real_controller = new $this->controller();
                } else {
                header('HTTP/1.1 405 Method Not Allowed');
                exit;
                }
            }
            else {
            header('HTTP/1.1 404 Not Found');
            exit;
            }
            return $real_controller->$this->finalmethod( $this->params );

    }
    



}
