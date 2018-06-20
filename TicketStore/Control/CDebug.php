<?php

class CDebug {
    
    public function getDebug() {
        $sessione = USingleton::getInstance('USession');
        $db = USingleton::getInstance('FBiglietto');

        $ordine = $sessione->recupera_valore('ordine');
        /*$zona = new EZona('curva', 10);
        $result1 = $zona->assegnaPosti($ordine, 2);       
        $result2 = $db->loadPostiDisp($ordine);*/
        $biglietti = $db->load($ordine);
        //*
        echo "<pre>";
        var_dump($biglietti);
        echo "</pre>";//*/
    }
}
