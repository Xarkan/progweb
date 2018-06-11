<?php

class CDebug {
    
    public function getDebug() {
        $sessione = USingleton::getInstance('USession');
        /*$ordine = $sessione->recupera_valore('ordine');
        $num = 2;
        $zona = new EZona("pippo", 13);
        $prova = new EPartecipazione($zona, 15.50, true);
        $ordine->addElementi($prova, $num);
        $sessione->imposta_valore('ordine',$ordine);*/
        
        /*$zona = new EZona("pippo", 13);
        $prova = new EPartecipazione($zona, 15.50, true);
        $ordine = new EOrdine();
        $ordine->setNomeEvento('Prova in concert');
        $ordine->addElementi($prova, 2);
        $ordine->setPagato(false);
        $sessione->imposta_valore('ordine',$ordine);*/
        
        echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";
    }
}
