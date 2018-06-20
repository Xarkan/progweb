<?php


class CRegistrazione {
    
    public function postRegistrazione() {
       
        $db = USingleton::getInstance('FDBmanager');
        $sessione = USingleton::getInstance('USession');
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $mail = $_POST['mail'];
        $password = $_POST['psw'];
        $conferma_psw = $_POST['conferma_psw'];
        
        $utente = new EUtente_Reg($nome, $cognome, $mail, $password);
        
        $dominio = explode('@', $mail);
        if($dominio[1] != 'ticketstore.it') { 
            if($mail != "" && $password != "" && $conferma_psw != ""){
                if($password == $conferma_psw){
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
                            $sessione->imposta_valore('utente',$utente);
                            header('HTTP/1.1 301 Moved Permanently');
                            header('Location: ValidazioneUtente');
                        }
                   }
                
                }
                else{
                    echo '<script type="text/javascript">
                               alert("Le password inserite non coincidono.")
                               window.location= "/TicketStore/signin"
                             </script>';
                }
         }else{
             echo '<script type="text/javascript">
                        alert("Il formato della mail inserita non è valido.")
                        window.location= "/TicketStore/signin"
                      </script>';
          }
        }
    }     
}
