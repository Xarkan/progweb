<?php


class CPagamento {
    
    public function getPagamento() {
        $sessione = USingleton::getInstance('USession');
        $ordine = $sessione->recupera_valore('ordine');
        $ordine->setPagato(true);
        echo "pagato --------> edgardo bestia";
        //tutta la roba da fare nel db
        
    }
}
