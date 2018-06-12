<?php

class CDebug {
    
    public function getDebug() {
        $sessione = USingleton::getInstance('USession');
        $db = USingleton::getInstance('FDBmanager');
        $result = $db->load('evento0'/*,'2018-05-29'*/);
        //*
        echo "<pre>";
        print_r($result);
        echo "</pre>";//*/
        //echo $result;
    }
}
