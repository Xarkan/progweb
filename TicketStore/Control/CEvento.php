<?php

class CEvento {
    
    public function getEvento($id) {
        $sessione = USingleton::getInstance('USession');
        $ordine = USingleton::getInstance('EOrdine');
        
        $eventi = $sessione->recupera_valore('eventi');
        $ordine->setNomeEvento($eventi[$id]->getNome());
        $img = $eventi[$id]->getImg();
        $sessione->imposta_valore('ordine',$ordine);
        $sessione->imposta_valore('img',$img);
        $view = USingleton::getInstance('VEvento');
        $view->setLuoghiDate($id);
    }
}
