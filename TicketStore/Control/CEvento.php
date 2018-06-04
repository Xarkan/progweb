<?php

class CEvento {
    
    public function getEvento($id) {
        $sessione = USingleton::getInstance('USession');
        $ordine = USingleton::getInstance('EOrdine');
        
        $decoded = json_decode($sessione->recupera_valore('eventi'),true);
        $ordine->setNomeEvento($decoded[$id]["nome"]);
        $sessione->imposta_valore('ordine',$ordine);
        header('Location: /TicketStore/View/html/dettagli.html?id='.$id);
    }
}
