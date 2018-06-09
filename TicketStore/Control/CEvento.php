<?php

class CEvento {
    
    public function getEvento($id) {
        $sessione = USingleton::getInstance('USession');
        $ordine = USingleton::getInstance('EOrdine');
        
        $eventi = $sessione->recupera_valore('eventi');
        $ordine->setNomeEvento($eventi[$id]->getNome());
        $sessione->imposta_valore('ordine',$ordine);
        /*$view = USingleton::getInstance('VEvento');
        $view->setLuoghiDate($id);*/
    }
}
