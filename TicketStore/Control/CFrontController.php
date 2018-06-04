<?php


class CFrontController {
    private $controller;
    private $finalmethod;
    private $params = '';
    private $file;
            
    function __construct() {        
        $cleared_url = str_replace("/TicketStore/", "", $_SERVER['REQUEST_URI']);
        $result = explode("/",$cleared_url);

        $this->controller = 'C'.$result[0];
        $this->file = $this->controller.".php";
            
        $method = $_SERVER['REQUEST_METHOD'];
        $this->finalmethod = $method.$result[0];
        if(isset($result[1])) {
            $this->params = $result[1];
        }
    }
    
    function run(){
        
        if(!file_exists("Control/".$this->file)) { 
            $chome=Usingleton::getInstance('CHome');
            $chome->avviaHome();
            exit;
            }
            else {
                if ( method_exists($this->controller, $this->finalmethod ) ) {
                    $object = new $this->controller();
                } else {                    
                //header('HTTP/1.1 405 Method Not Allowed');   
                        $chome=Usingleton::getInstance('CHome');
                        $chome->avviaHome();
                        exit;
                    }
                  
            }
        $fmethod = $this->finalmethod;
        return $object->$fmethod( $this->params );
            
    }
    



}
