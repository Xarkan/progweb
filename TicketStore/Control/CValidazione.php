<?php


class CValidazione {
     
    public function postValidazione() {
        
        $db = USingleton::getInstance('FDBmanager');
        $sessione = USingleton::getInstance('USession');
        
        $mail = $_POST['mail'];
        $psw = md5($_POST['psw']);
        
        if($mail != "" && $psw != ""){
            $utente = new EUtente_Reg("","",$mail,$psw);
            $psw_db = $db->load($utente);
            $registrato = $db->exist($utente);
            /*var_dump($registrato);
            echo '<pre>';
            echo $psw_db[0];
            echo '</pre>';
            echo '<pre>';
            echo $psw;
            echo '</pre>';*/
            if($registrato && $psw === $psw_db[0]){
                var_dump($registrato);
                $sessione->imposta_valore('logged',true);
                header('HTTP/1.1 301 Moved Permanently');
                header('Location: home.html');
                /*qui dobbiamo trovare il modo di rimandare l'utente 
                 * all'ordine se lo stava effettuando oppure di mandarlo alla
                 * home...credo che possiamo farlo con la sessione
                 */
            }
            else if($registrato && $psw != $psw_db){
                header('HTTP/1.1 301 Moved Permanently');
                header('Location: login');
                /*qui dobbiamo trovare il modo di comunicare all'utente
                 * che la password inserita è sbagliata
                 */
            }
            else if(!$registrato){
                header('HTTP/1.1 301 Moved Permanently');
                header('Location: signin');
                /*qui dobbiamo trovare il modo di dire all'utente che non 
                 * è ancora registrato e che deve registrarsi
                 */
            }
            
        }
            
        
        
    }
}
