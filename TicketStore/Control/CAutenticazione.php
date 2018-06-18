<?php


class CAutenticazione {
    
    public function getAutenticazione() {
        $this->logout();
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
        $sessione = USingleton::getInstance('USession');
        $sessione->distruggiSessioneCookie();
        $view = USingleton::getInstance('View');
        $view->set_html_logout();
    }
}
