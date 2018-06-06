<?php


class CSignin {
    
    public function postSignin() {
         $db = USingleton::getInstance('FDBmanager');
         $sessione = USingleton::getInstance('USession');
         
         if($_POST['mail'] != "" && $_POST['psw'] != "" ){
             $utente = new EUtente_Reg($_POST['nome'], $_POST['cognome'], $_POST['mail'], $_POST['psw']);
             $exist = $db->exist($utente);
             if($exist){
                 header('location : /TicketStore/Signin' );
             }
             else{
                 $registrato = $db->store($utente);
                 if(!$registrato){
                        $sessione->imposta_valore('logged', false);
                        header('location : location : /TicketStore/Signin' );
                        echo 'ERRORE! La registrazione non è avvenuta';
                    }else{
                         $sessione->imposta_valore('logged',true);
                         header('location : /TicketStore/evento/0');
                    }
            }
             
         }
    }
}
