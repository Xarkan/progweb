<?php

class CEvento {
    
    /*public function getEvento_old($id) {
        $sessione = USingleton::getInstance('USession');
        $ordine = USingleton::getInstance('EOrdine');
        
        $eventi = $sessione->recupera_valore('eventi');
        $ordine->setNomeEvento($eventi[$id]->getNome());
        $img = $eventi[$id]->getImg();
        $sessione->imposta_valore('ordine',$ordine);
        $sessione->imposta_valore('img',$img);
        $view = USingleton::getInstance('VEvento');
        $view->set_html($id);
    }*/
    
    public function getEvento($id) {
        $sessione = USingleton::getInstance('USession');
        $db = USingleton::getInstance('FDBmanager');
        $ordine = USingleton::getInstance('EOrdine');
        
        $evento = $db->load($id);
        $ordine->setNomeEvento($evento->getNome());
        $img = $evento->getImg();
        $sessione->imposta_valore('ordine',$ordine);
        $sessione->imposta_valore('img',$img);
        $view = USingleton::getInstance('VEvento');
        $view->set_html($id);
    }
}
