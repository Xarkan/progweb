<?php

class CEvento {
    
    public function getEvento($id) {
        $sessione = USingleton::getInstance('USession');
        $db = USingleton::getInstance('FDBmanager');
        $ordine = USingleton::getInstance('EOrdine');
        
        if($sessione->is_set('ordine')) {
            $sessione->distruggiValore('ordine');
        }
        
        $evento = $db->load($id);
        $ordine->setCode($id);
        $ordine->setNomeEvento($evento->getNome());
        $img = $evento->getImg();
        $sessione->imposta_valore('ordine',$ordine);
        $sessione->imposta_valore('img',$img);
        $view = USingleton::getInstance('VEvento');
        $view->set_html($id);
    }
}
