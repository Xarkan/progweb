<?php


class CHome {
    
    public function avviaHome() {
        header('Location: /TicketStore/View/html/home.html');
    }
    
    public function getHome() {
        $db = USingleton::getInstance('FDBmanager');
        //$ordine = USingleton::getInstance('EOrdine');
        $sessione = USingleton::getInstance('USession');
        //$eventi_generici deve essere un array tipo $array[k].path_img
        $eventi_generici = $db->load('eventi');

        $json = json_encode($eventi_generici);
        $sessione->imposta_valore('eventi',$json);
        echo $json;
    }
    
    
}
