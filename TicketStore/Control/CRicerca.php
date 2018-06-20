<?php

class CRicerca {
    
    public function postRicerca() {
        $db = USingleton::getInstance('FDBmanager');
        $sessione = USingleton::getInstance('USession');
        
        $nome_evento = $_POST['nome_evento'];
        $eventi = $db->search($nome_evento);
        //print_r($eventi);
        $sessione->imposta_valore('ricerca',$eventi);
        $vricerca = USingleton::getInstance('VRicerca');
        $vricerca->set_html();
        
        
        
    }
}
