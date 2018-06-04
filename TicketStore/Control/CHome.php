<?php


class CHome {
    
    public function avviaHome() {
        header('Location: /TicketStore/View/html/home.html');
    }
    
    public function getHome() {
        $db = USingleton::getInstance('FDBmanager');        
        $sessione = USingleton::getInstance('USession');
        
        $eventi_generici = $db->recuperoDati();
        $json = json_encode($eventi_generici);
        
        $sessione->imposta_valore('eventi',$json);
        echo $json;
    }
    
    
}
