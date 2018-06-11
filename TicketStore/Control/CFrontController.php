<?php


class CFrontController {
    private $controller;
    private $finalmethod;
    private $param1 = '';
    private $param2 = '';
    private $param3 = '';
    private $file;
            
    function __construct() {        
        $cleared_url = str_replace("/TicketStore/", "", $_SERVER['REQUEST_URI']);
        $result = explode("/",$cleared_url);

        $this->controller = 'C'.$result[0];
        $this->file = $this->controller.".php";
    
        $method = $_SERVER['REQUEST_METHOD'];
        $this->finalmethod = $method.$result[0];
        if(isset($result[1])) {
            $this->param1 = $result[1];
            if(isset($result[2])) {
                $this->param2 = $result[2];
                if(isset($result[3])) {
                    $this->param3 = $result[3];
                }
            }
        }
       
    }
    
    function run(){
    
        if(!file_exists("Control/".$this->file)) {
            
            $view=Usingleton::getInstance('View');
            $view->avviaHome();
            exit;
            }
            else {
                if ( method_exists($this->controller, $this->finalmethod ) ) {
                    $object = new $this->controller();
                } else {                    
                //header('HTTP/1.1 405 Method Not Allowed');   
                    $view=Usingleton::getInstance('View');
                    $view->operazioneInvalida(); //?????
                    exit;
                    }
                  
            }
        $fmethod = $this->finalmethod;

        if($this->param2 == '') {
            return $object->$fmethod( $this->param1 );
        }
        else {
            if($this->param3 == '') {
                return $object->$fmethod( $this->param1, $this->param2 );
            }
            else {
                return $object->$fmethod( $this->param1, $this->param2, $this->param3 );
            }
        }
      }
    



}
