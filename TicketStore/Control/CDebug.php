<?php

class CDebug {
    
    public function getDebug() {
        $sessione = USingleton::getInstance('USession');
        $db = USingleton::getInstance('FBiglietto');
        /*$sql = "SELECT code FROM evento ORDER BY code DESC LIMIT 1";
        $result = $db->getConnection()->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_COLUMN,0);*/
        
        $ordine = $sessione->recupera_valore('ordine');
        $db->updateBiglietti($ordine);
        /*echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";*/
    }
}
