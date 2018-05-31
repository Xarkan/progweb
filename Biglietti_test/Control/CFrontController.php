<?php


class CFrontController {
    protected $controller;
    protected $finalmethod;
    protected $params;
    
    function __construct() {}
    
    function run(){
        $resource = $_SERVER['$_REQUEST_URI'];
        $this->controller = 'C'.$resource;
        $method = $_SERVER['$_REQUEST_METHOD'];
        $this->finalmethod = $method.$resource;
        $this->params = ['$_REQUEST_URI'];
        
        if ( class_exists( $controller ) ) {
            if ( method_exists($controller, $finalmethod ) ) {
                $real_controller = new $controller();
                } else {
                header('HTTP/1.1 405 Method Not Allowed');
                exit;
                }
            }
            else {
            header('HTTP/1.1 404 Not Found');
            exit;
            }
            return $real_controller->$method( $params );
    }
    



}
