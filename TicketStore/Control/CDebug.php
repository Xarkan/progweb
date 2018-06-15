<?php

class CDebug {
    
    public function getDebug() {
        /*$sessione = USingleton::getInstance('USession');
        $zona = new EZona("pippo", 5);
        $posto = new EPosto(3,2);
        //*
        echo "<pre>";
        print_r($sessione->recupera_valore('posti'));
        echo "</pre>";//*/
        //echo $result;*/
        
        $db = USingleton::getInstance('FDBmanager');
        $sql = "SELECT LAST_INSERT_ID() FROM ordine";
        $result = $db->getConnection()->query($sql);
        $rows = $result->fetchAll();
        //var_dump($rows);
        echo $rows[0][0];
    }
}
