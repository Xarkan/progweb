<?php

class CAcquistoBiglietto {
    
    //attributi
    
    //metodi
    public function impostaDLP() {
        $sessione = USingleton::getInstance('USession');
        $json = $sessione->recupera_valore('eventi');
        $eventi_generici = json_decode($json, true);
        var_dump($eventi_generici);
        $eventi_specifici = $evento_generico->getEventi();
    }
    
    public function dataLuogoPrezzo($id) {
        $dlp = new VDataLuogoPrezzo();
        
                $sessione = USingleton::getInstance('USession');
        $json = $sessione->recupera_valore('eventi');
        $eventi_generici = json_decode($json, true);
        var_dump($eventi_generici);
        
        $dlp->setDataIntoTemplate('id', $id);
        $dlp->setTemplate('DataLuogoPrezzo.tpl');
    }
    
    
    public function mostraZona(EEvento $evento) {
        $lista_zone = $evento->mostraZona();
        for($i = 0;$i<count($lista_zone);$i++){
            $array[$i]['zona'] = $lista_zone[$i]->getZona();
            $array[$i]['prezzo'] = $lista_zone[$i]->getPrezzo();
        }
        $zona = new VZona();
        $zona->setDataIntoTemplate('results',$array);
        $zona->setTemplate('zoneEvento.tpl');
    }
    
    public function aggiungiAlCarrello(EBiglietti_Zona $zona_selezionata, $num_biglietti) {
        $ordine = new EOrdine();
        $ordine->addZone($zona_selezionata, $num_biglietti);
        for($i = 0;$i<$num_biglietti;$i++){
            $array[$i]['zona'] = $zona_selezionata->getZona();
            $array[$i]['prezzo'] = $zona_selezionata->getPrezzo();
            //...
        }

    }

    public function rimuoviDalCarrello() {

    }
    
    public function confermaPagamento() {
        
    }
    
    
    
    public function DataLuogoPrezzo_vecchio($id) { 
        //apro la connessione con il db
        USingleton::getInstance('USession');
        $evento = $_SESSION[$id];
        $fdbm = new FDBmanager();
        $results = $fdbm->loadDataLuogoPrezzo($evento);
        $DataLuogoPrezzo = new VDataLuogoPrezzo();
        $DataLuogoPrezzo->setDataIntoTemplate('rows', $results);
        $DataLuogoPrezzo->setTemplate('DataLuogoPrezzo.tpl');
        
    }
}



