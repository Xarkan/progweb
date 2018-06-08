<?php

class CZone {
    
    public function getZone($id_e, $id_esp) {
        $sessione = USingleton::getInstance('USession');
        $ordine = $sessione->recupera_valore('ordine');
        
        $decoded = json_decode($sessione->recupera_valore('eventi'),true);
        $ordine->setEvento($decoded[$id_e][$id_esp]);
        $sessione->imposta_valore('ordine',$ordine);
        //$sessione->imposta_valore('cod_e',$id_e);
        //$sessione->imposta_valore('cod_esp',$id_esp);
        
        $this->controlloPartecipazioni($id_e, $id_esp);
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
