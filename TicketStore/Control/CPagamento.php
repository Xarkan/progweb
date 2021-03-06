<?php


class CPagamento {
    
    public function getPagamento() {
        $sessione = USingleton::getInstance('USession');
        $validazione = USingleton::getInstance('CValidazione');
        $db = USingleton::getInstance('FDBmanager');
        $ordine = $sessione->recupera_valore('ordine');
        
        if($validazione->isLogged()) { //una roba simile per l'utente che si è registrato
            $utente = $sessione->recupera_valore('utente'); 
            if($utente instanceof EUtente_Reg) {  
                $ordine->setUtente($utente);
                $view = USingleton::getInstance('VPagamento');
                $view->set_html_metodo();
            }else{
                $view = USingleton::getInstance('View');
                $view->operazioneInvalida();
            }    
        } else { //bisogna farlo tornare dopo il login all'ordine
            $pagina = "/TicketStore/pagamento";
            $sessione->imposta_valore('pagina', $pagina);
            header("Location: /TicketStore/login");
        }

    }
    
    
    public function postPagamento() {
        $sessione = USingleton::getInstance('USession');
        $db = USingleton::getInstance('FDBmanager');
        $ordine = $sessione->recupera_valore('ordine');
        if(!isset($_SESSION['acquistato'])) {
        try {  
            $db->getConnection()->beginTransaction();  
            $ordine->setPagato(true);
            
            $ordine->setData();
            
            $stored = $db->store($ordine);
            if($stored) {
                //qui si fa update biglietto 
                $updated = $db->update($ordine);
                if($updated) {                     
                    $db->getConnection()->commit();
                    $biglietti = $db->load($ordine);
                    $sessione->imposta_valore('biglietti',$biglietti);
                    $sessione->imposta_valore('acquistato', true);
                    $view = USingleton::getInstance('VPagamento');
                    $view->set_html_biglietti();
                }else {
                    $db->getConnection()->rollBack();
                }
            }else {
                $db->getConnection()->rollBack();
            }           
        }
        catch (Exception $e) {            
            echo $e->getMessage();
        }
        }else{
            $view = USingleton::getInstance('VPagamento');
            $view->set_html_biglietti();
        }
    }
}

