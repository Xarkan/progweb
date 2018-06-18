<?php


class CValidazione {
     
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
                
                $nom_cogn = explode(" ", $result[0]['nome']);
                $utente->setNome($nom_cogn[0]);
                $utente->setCognome($nom_cogn[1]);
                
                $sessione->imposta_valore('utente',$utente);
                if(isset($_SESSION['pagina'])) {
                    $pagina = $sessione->recupera_valore('pagina');
                }else{
                    $pagina = "/TicketStore/home";
                }
                
                header('HTTP/1.1 301 Moved Permanently');
                header('Location: '.$pagina);
                
                /*qui dobbiamo trovare il modo di rimandare l'utente 
                 * all'ordine se lo stava effettuando oppure di mandarlo alla
                 * home...credo che possiamo farlo con la sessione
                 */
            }
            else if($registrato && $psw != $result[0]['psw']){
                /*header('HTTP/1.1 301 Moved Permanently');
                header('Location: login');*/
                echo '<script type="text/javascript">
                        alert("la password inserita è sbagliata.")
                        window.location= "/TicketStore/login"
                      </script>'; 
                /*qui dobbiamo trovare il modo di comunicare all'utente
                 * che la password inserita è sbagliata
                 */
            }
            else if(!$registrato){
                /*header('HTTP/1.1 301 Moved Permanently');
                header('Location: signin');*/
                echo '<script type="text/javascript">
                        alert("la mail inserita non è stata ancora registrata. Procedi alla registrazione")
                        window.location= "/TicketStore/signin"
                      </script>';
                /*qui dobbiamo trovare il modo di dire all'utente che non 
                 * è ancora registrato e che deve registrarsi
                 */
            }
            
        }
            
        
        
    }
}
