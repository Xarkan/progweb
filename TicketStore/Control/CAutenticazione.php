<?php


class CAutenticazione {
    
    public function getAutenticazione() {
        
    }
    
    public function isLogged() {
        if(isset($_SESSION['logged'])) {
            if($_SESSION['logged']) {
                $logged = true;
            }else{
                $logged = false;
            }
        }else{
            $logged = false;
        }
        return $logged;
    }
    
    public function logout() {
        
    }
}
