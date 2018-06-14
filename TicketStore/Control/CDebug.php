<?php

class CDebug {
    
    public function getDebug() {
        $sessione = USingleton::getInstance('USession');
        $zona = new EZona("pippo", 5);
        $posto = new EPosto(3,2);
        //*
        echo "<pre>";
        print_r($sessione->recupera_valore('posti'));
        echo "</pre>";//*/
        //echo $result;
    }
}
