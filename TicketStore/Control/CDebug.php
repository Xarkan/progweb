<?php

class CDebug {
    
    public function getDebug() {
        $sessione = USingleton::getInstance('USession');
        $db = USingleton::getInstance('FDBmanager');
        
        $ev = new ESpettacolo("sdfshdf", "data", "partecipazioni");
        $tipo = str_replace("E","",get_class($ev));       
       
        $feventosp = USingleton::getInstance('FEventoSPecifico');
        $tipoz = $feventosp->loadTipo(1)['tipo'];
        
        
        echo "<pre>";
        print_r($tipoz);
        echo "</pre>";//*/
    }
}
