<?php


class CHome {
        
    public function getHome() {
        $db = USingleton::getInstance('FDBmanager');        
        $sessione = USingleton::getInstance('USession');
        
        $eventi_generici = $db->recuperoDati();
        
        $sessione->imposta_valore('eventi',$eventi_generici);
        
        $vhome = USingleton::getInstance('VHome');
        $vhome->print_json($eventi_generici);
    }
    
    
}
