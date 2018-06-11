<?php

class CZona {
    
    public function getZona($id_e, $id_esp) {
        $sessione = USingleton::getInstance('USession');
        $ordine = $sessione->recupera_valore('ordine');
        
        $eventi = $sessione->recupera_valore('eventi');
        $ev_specifico = $eventi[$id_e]->getEventoSingolo($id_esp);
        $ordine->setEvento($ev_specifico);
        $sessione->imposta_valore('ordine',$ordine);        
        $view = USingleton::getInstance('VZona');
        $view->set_html($id_e, $id_esp);
        
        //$this->controlloPartecipazioni($id_e, $id_esp);
    }
    
    //qui viene aperta la pagina delle zone e bisogna fare un controllo sulle
    //partecipazioni disponibili
    public function controlloPartecipazioni($id_e, $id_esp) {
        /*$sessione = USingleton::getInstance('USession'); 
        $decoded = json_decode($sessione->recupera_valore('eventi'),true);
        $array_part = $decoded[$id_e][$id_esp];
        for ($i = 0; $i < count($array_part); $i++) {
            $partecipazioni[$i] = new EPartecipazione($array_part[$i]['zona'], $array_part[$i]['zona']);
        }*/
        
    }
}
