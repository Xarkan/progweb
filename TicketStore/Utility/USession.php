<?php

class USession {

    public function __construct() {
        
        ini_set('session.gc_divisor',50);
        ini_set('session.gc_probability',1); //Session.gc_probability e session.gc_divisor definire la probabilità che il processo di garbage collection viene eseguito su ogni inizializzazione di sessione
        ini_set('session.gc_maxlifetime',"7200");// vita sul server prima di essere contrassegnato come spazzatura
        ini_set('session.cookie_lifetime',"3600");//vita sul client del cookie , la metto uguale al marchingennio della sessione         //  session_set_cookie_params('3600');
        
        session_start();
    }
    
    function is_set($string) {
        if(isset($_SESSION[$string])) {
            $bool = true;
        }else{
            $bool = false;
        }
        return $bool;
    }

// imposta valore sessione
    function imposta_valore($chiave,$valore) {
        $_SESSION[$chiave]=$valore;
    }
    
    function recupera_valore($chiave) {
        $valore = $_SESSION[$chiave];
        return $valore;
    }
    
    function distruggiValore($string) {
        $bool  = false;
        if(isset($_SESSION[$string])) {
            unset($_SESSION[$string]);
            $bool = true;
        }
        return $bool;
    }

    
    function distruggiSessioneCookie(){
            $_SESSION = array();// Desetta tutte le variabili di sessione.
            session_destroy();// Infine distrugge la sessione.  
            setcookie("PHPSESSID",null,time()-3600);//cancella cookie

    }
    


}
?>