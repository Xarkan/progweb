<?php

class CZona {    
    
    public function getZona($id_e, $id_esp) {
        $sessione = USingleton::getInstance('USession');
        $db = USingleton::getInstance('FDBmanager');
        $ordine = $sessione->recupera_valore('ordine');

        $evento_sp = $db->load($id_e, $id_esp);
        $ordine->setEvento($evento_sp);
        $sessione->imposta_valore('ordine',$ordine);        
        $view = USingleton::getInstance('VZona');
        $view->set_html($id_e, $id_esp);
    }
    
}
