<?php


class CPagamento {
    
    public function getPagamento() {
        $sessione = USingleton::getInstance('USession');
        $db = USingleton::getInstance('FDBmanager');
        $ordine = $sessione->recupera_valore('ordine');
        
        if(isset($_SESSION['logged'])) { //una roba simile per l'utente che si è registrato
              
            $utente = $sessione->recupera_valore('utente'); //è un oggetto utente_reg
            $ordine->setUtente($utente);
          try {  
            $db->getConnection()->beginTransaction();  
            $ordine->setPagato(true);           
            $stored = $db->store($ordine); //fa sia dentro ordine che dentro ord_part
        
            if($stored) {
                //qui si fa update biglietto 
                $updated = $db->update($ordine);
                if($updated) {
                    $biglietti = $db->load($ordine);
                    $view = USingleton::getInstance('VPagamento');
                    $view->set_html();
                }
            }
            $db->getConnection()->commit();
          }
          catch (Exception $e) {
            $db->getConnection()->rollBack();
            echo $e->getMessage();
          }
        } else { //bisogna farlo tornare dopo il login all'ordine
            header("Location: /TicketStore/login");
        }
      
    }
}
