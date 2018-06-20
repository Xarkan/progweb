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
        
        //$this->controlloPartecipazioni($id_e, $id_esp);
    }
    
    //qui viene aperta la pagina delle zone e bisogna fare un controllo sulle
    //partecipazioni disponibili
    public function controlloPartecipazioni($id_e, $id_esp) {
        $sessione = USingleton::getInstance('USession'); 
        $decoded = json_decode($sessione->recupera_valore('eventi'),true);
        $array_part = $decoded[$id_e][$id_esp];
        for ($i = 0; $i < count($array_part); $i++) {
            $partecipazioni[$i] = new EPartecipazione($array_part[$i]['zona'], $array_part[$i]['zona']);
        }
        
    }
}
