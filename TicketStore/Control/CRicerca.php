<?php

class CRicerca {
    
    public function postRicerca() {
        
        $db = USingleton::getInstance('FDBmanager');
        $sessione = USingleton::getInstance('USession');
        
        if($_POST['concerti'] == 'Concerto'){
            $eventi = $db->loadconcspettsport($_POST['concerti']);
        }else if($_POST['spettacoli'] == 'Spettacolo'){
            $eventi = $db->loadconcspettsport($_POST['spettacoli']);
        }else if($_POST['sport'] == 'Partita'){
            $eventi = $db->loadconcspettsport($_POST['sport']);
        }else{
            $nome_evento = $_POST['nome_evento'];
            $eventi = $db->search($nome_evento);
        }
        //var_dump($eventi);
            
        
        
        
        
        //print_r($_POST);
        //print_r($eventi);
        $sessione->imposta_valore('ricerca',$eventi);
        $vricerca = USingleton::getInstance('VRicerca');
        $vricerca->set_html();
        
    }
}
