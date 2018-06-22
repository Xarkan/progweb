<?php

class CRicerca {
    
    public function postRicerca() {
        
        $db = USingleton::getInstance('FDBmanager');
        $sessione = USingleton::getInstance('USession');
        
        if($_POST['concerti'] == 'Concerto'){
            $eventi = $db->search($_POST['concerti'],'tipo');           
        }else if($_POST['spettacoli'] == 'Spettacolo'){
            $eventi = $db->search($_POST['spettacoli'],'tipo');
        }else if($_POST['sport'] == 'Partita'){
            $eventi = $db->search($_POST['sport'],'tipo');
        }else{
            $nome_evento = $_POST['nome_evento'];
            $eventi = $db->search($nome_evento,'nome');
        }
        //var_dump($eventi);

        
        
        //print_r($_POST);
        //print_r($eventi);
        //*
        $sessione->imposta_valore('ricerca',$eventi);
        $vricerca = USingleton::getInstance('VRicerca');
        $vricerca->set_html();//*/
        //$sessione->distruggiValore('ricerca');
    }
}
