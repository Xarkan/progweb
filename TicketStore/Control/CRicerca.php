<?php

class CRicerca {
    
    public function postRicerca() {
        $db = USingleton::getInstance('FDBmanager');
        $sessione = USingleton::getInstance('USession');
        
        $nome_evento = $_POST['nome_evento'];
        $eventi = $db->search($nome_evento);
        //print_r($eventi);
        $vricerca = USingleton::getInstance('VRicerca');
        //$vricerca->print_json($eventi);
       //$vricerca->set_html();
        
        
        
    }
}
