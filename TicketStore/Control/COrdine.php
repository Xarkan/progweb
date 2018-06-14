<?php


class COrdine {
    
    public function getOrdine($param) {
        if($param == 'json') {
        $sessione = USingleton::getInstance('USession');
        $dettagli_ordine['ordine'] = $sessione->recupera_valore('ordine');
        $dettagli_ordine['img'] = $sessione->recupera_valore('img');
        //$dettagli_ordine['posti'] = $sessione->recupera_valore('posti');
        $view = USingleton::getInstance('View');
        $view->print_json($dettagli_ordine);
        
        }
        else {
            header('Location: /TicketStore/carrello');
        }
        
    }
    
    public function postOrdine($id_e, $id_esp, $id_part) {
        $sessione = USingleton::getInstance('USession');
        $db = USingleton::getInstance('FDBmanager');
        $ordine = $sessione->recupera_valore('ordine');
        
        $evento_sp = $db->load($id_e, $id_esp);
        $part = $evento_sp->selezionePartecipazione($id_part);
        $num = $_POST['num_bigl'];
                
        $ordine->addElementi($part, $num);
        
        $posti = $part->getPostiAssegnati($num);
        $sessione->imposta_valore('posti',$posti);
        
        $sessione->imposta_valore('ordine',$ordine);
        $view = USingleton::getInstance('VOrdine');
        $view->set_html();
    }
}
