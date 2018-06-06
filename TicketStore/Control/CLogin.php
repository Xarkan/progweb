<?php


class CLogin {
     
    public function postlogin() {
        
        $db = USingleton::getInstance('FDBmanager');
        $sessione = USingleton::getInstance('USession');
        
        $mail = $_POST['mail'];
        $psw = $_POST['psw'];
        
        if($mail != "" && $psw != ""){
            $utente = new EUtente_Reg("","",$mail,$psw);
            $registarto = $db->exist($utente);
            if($registrato){
                $sessione->imposta_valore('logged',true);
            }
            else{
                $sessione->imposta_valore('logged',false);
                header('location : /TicketStore/signin');
            }
        }
            
        
        
    }
}
