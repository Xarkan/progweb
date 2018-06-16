<?php

class CDebug {
    
    public function getDebug() {
        
        $db = USingleton::getInstance('FDBmanager');
        $mail = "federicoraparelli@hotmail.it";
        $psw = md5("pluto");
        $utente = new EUtente_Reg("","",$mail,$psw);
        $psw_db = $db->load($utente);
        
        echo "<pre>";
        print_r($psw_db);
        echo "</pre>";
    }
}
