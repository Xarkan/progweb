<?php


class CValidazione {
    
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
    
    
    public function getValidazione() {
        $sessione = USingleton::getInstance('USession');
        if(isset($_SESSION['utente'])) {
            $utente = $sessione->recupera_valore('utente');
            if($this->isLogged() && $utente == 'amministratore'){
                $view = USingleton::getInstance('VAmministrazione');
                $view->set_html();
            }else{
                $view = USingleton::getInstance('View');
                $view->avviaHome();
            }
        }else{
            $view = USingleton::getInstance('View');
            $view->avviaHome();
        }    
        
    }
    
         
    public function postValidazione() {
        
        $db = USingleton::getInstance('FDBmanager');
        $sessione = USingleton::getInstance('USession');
        
        $mail = $_POST['mail'];
        $psw = md5($_POST['psw']);
        
        if($mail != "" && $psw != ""){
            $utente = new EUtente_Reg("","",$mail,$psw);
            $result = $db->load($utente);
            $registrato = $db->exist($utente);          /*qui bisogna istanziare un oggetto utente completo da
                                                         *salvare nella sessione per passarlo all'ordine*/   
            if($registrato && $psw === $result[0]['psw']){
                $sessione->imposta_valore('logged',true);
                $dominio = explode('@', $mail);
                if($dominio[1] != 'ticketstore.it') { //controlla che non sia amministratore
                    $nom_cogn = explode(" ", $result[0]['nome']);
                    $utente->setNome($nom_cogn[0]);
                    $utente->setCognome($nom_cogn[1]);
                    var_dump($utente);
                    $sessione->imposta_valore('utente',$utente);
                    if(isset($_SESSION['pagina'])) {
                        $pagina = $sessione->recupera_valore('pagina');
                    }else{
                        $pagina = "/TicketStore/home";
                    }
                }else{
                    $utente = 'amministratore';
                    $sessione->imposta_valore('utente',$utente);
                    $pagina = '/TicketStore/validazione';
                }
                header('HTTP/1.1 301 Moved Permanently');
                header('Location: '.$pagina);
                
            }
            else if($registrato && $psw != $result[0]['psw']){
                
                echo '<script type="text/javascript">
                        alert("la password inserita è sbagliata.")
                        window.location= "/TicketStore/login"
                      </script>'; 
              
            }
            else if(!$registrato){
                
                echo '<script type="text/javascript">
                        alert("la mail inserita non è stata ancora registrata. Procedi alla registrazione")
                        window.location= "/TicketStore/signin"
                      </script>';
               
            }
            
        }
            
        
        
    }
}
