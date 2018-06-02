<?php

class View {

    public function getController()
    {
        if ( isset($_REQUEST['controller']))
            return $_REQUEST['controller'];
        else return false;
    }
    
    public function getTask(){
        if (isset($_REQUEST["task"])) {
            return $_REQUEST["task"];
        }    
        else return false;        
    }
    
    public function getElement() {
        if (isset($_REQUEST["id"])) {
            return $_REQUEST["id"];
        }    
        else return false; 
        
    }
      
}
