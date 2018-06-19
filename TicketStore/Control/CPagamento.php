<?php


class CPagamento {
    
    public function getPagamento() {
        $sessione = USingleton::getInstance('USession');
        $db = USingleton::getInstance('FDBmanager');
        $ordine = $sessione->recupera_valore('ordine');
        
        if(isset($_SESSION['logged'])) { //una roba simile per l'utente che si è registrato
                $utente = $sessione->recupera_valore('utente'); //è un oggetto utente_reg
                $ordine->setUtente($utente);
                $view = USingleton::getInstance('VPagamento');
                $view->set_html_metodo();
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
    }
}

/*              try {  
                $db->getConnection()->beginTransaction();  
                $ordine->setPagato(true);           
                $stored = $db->store($ordine); //fa sia dentro ordine che dentro ord_part
        
                if($stored) {
                //qui si fa update biglietto 
                    $updated = $db->update($ordine);  //questa parte va chiarita sul database
                    if($updated) {
                        $biglietti = $db->load($ordine);
                        $db->getConnection()->commit();
                        //roba di view del biglietto
                    }else {
                        $db->getConnection()->rollBack();
                    }
                }else {
                    $db->getConnection()->rollBack();
                }           
              }
              catch (Exception $e) {            
                echo $e->getMessage();
              }*/
