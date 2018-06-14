<?php


class CRegistrazione {
    
    public function postRegistrazione() {
       
         $db = USingleton::getInstance('FDBmanager');
         $sessione = USingleton::getInstance('USession');
         $nome = $_POST['nome'];
         $cognome = $_POST['cognome'];
         $mail = $_POST['mail'];
         $password = $_POST['psw'];
         $utente = new EUtente_Reg($nome, $cognome, $mail, $password);
         if($mail != "" && $password != "" ){
             $exist = $db->exist($utente);
             if($exist){
                 /*L'utente sta provando a registrarsi con una mail già usata per la registrazione
                 Viene reindirizzato al login...l'ideale sarebbe comunicare all'utente che o si logga 
                 o cambia mail per effettuare la registrazione
                 header('HTTP/1.1 301 Moved Permanently');
                 header('Location: login');*/
                 echo '<script type="text/javascript">
                        alert("La mail inserita è stata già registrata. Procedi al login")
                        window.location= "/TicketStore/login"
                      </script>'; 
                 
            }
            else{
                $registrato = $db->store($utente);
                if($registrato){
                    //la registrazione è avvenuta con successo l'utente viene reinderizzato nella bellissima
                    //pagina dove puo scegliere se andare alla home o procedere con l'ordine
                    $sessione->imposta_valore('logged',$registrato);
                    header('HTTP/1.1 301 Moved Permanently');
                    header('Location: ValidazioneUtente');
                }
                
                
            }
             
    }
   }
}
