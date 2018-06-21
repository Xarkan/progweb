<?php

class CReset {
    
    public function getReset() {
        $sessione = USingleton::getInstance('USession');
        $view = USingleton::getInstance('View');
        
        $sessione->distruggiValore('biglietti');
        $sessione->distruggiValore('acquistato');
        $sessione->distruggiValore('ordine');
        $sessione->distruggiValore('posti');
        $sessione->distruggiValore('img');
        
        $view->avviaHome();
    }
}
