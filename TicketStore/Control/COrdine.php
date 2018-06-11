<?php


class COrdine {
    
    public function getOrdine($param) {
        if($param == 'json') {
        $sessione = USingleton::getInstance('USession');
        $dettagli_ordine['ordine'] = $sessione->recupera_valore('ordine');
        $dettagli_ordine['img'] = $sessione->recupera_valore('img');
        $view = USingleton::getInstance('VOrdine');
        $view->print_json($dettagli_ordine);
        
        //$cod_e = $sessione->recupera_valore('cod_e');
        //$cod_esp = $sessione->recupera_valore('cod_esp');
        }
        else {
            header('Location: /TicketStore/carrello');
        }
        
    }
    
    public function postOrdine($id_e, $id_esp, $id_part) {
        $sessione = USingleton::getInstance('USession');
        $ordine = $sessione->recupera_valore('ordine');
        $eventi = $sessione->recupera_valore('eventi');
        $part = $eventi[$id_e]->getEventoSingolo($id_esp)->selezionePartecipazione($id_part);
        $num = $_POST['num_bigl'];

        $zona = new EZona("pippo", 13);
        $part->setZona($zona);
        $ordine->addElementi($part, $num);
        $sessione->imposta_valore('ordine',$ordine);
        $view = USingleton::getInstance('VOrdine');
        $view->set_html();
    }
}
