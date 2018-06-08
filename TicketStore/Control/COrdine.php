<?php


class COrdine {
    
    public function getOrdine($param) {
        $sessione = USingleton::getInstance('USession');
        $ordine = $sessione->recupera_valore('ordine');
       
        $view = USingleton::getInstance('VOrdine');
        $view->print_json($ordine);
        
        //$cod_e = $sessione->recupera_valore('cod_e');
        //$cod_esp = $sessione->recupera_valore('cod_esp');
        
        
    }
    
    public function postOrdine() {
        $sessione = USingleton::getInstance('USession');
        $ordine = $sessione->recupera_valore('ordine');
        $num = $_POST['num_bigl'];
        $zona = new EZona("pippo", 13);
        $prova = new EPartecipazione($zona, 15.50, true);
        $ordine->addElementi($prova, $num);
        $sessione->imposta_valore('ordine',$ordine);
    }
}
