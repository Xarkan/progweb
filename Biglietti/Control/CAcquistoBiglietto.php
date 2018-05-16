<?php

class CAcquistoBiglietto {
    
    //attributi
    
    //metodi
    public function DataLuogoPrezzo(EEvento $evento) { 
        //apro la connessione con il db
        $fdbm = new FDBmanager();
        $results = $fdbm->loadDataLuogoPrezzo($evento);
        $DataLuogoPrezzo = new VDataLuogoPrezzo();
        $DataLuogoPrezzo->setDataIntoTemplate('rows', $results);
        $DataLuogoPrezzo->setTemplate('DataLuogoPrezzo.tpl');
        //$fdbm->getConnection()->close();
        
    }
    
    public function mostraZona(EEvento $evento) {
        $lista_zone = $evento->mostraZona();
        $zona = new VZona();
        $zona->setDataIntoTemplate('results',$lista_zone);
        $zona->setTemplate('zoneEvento.tpl');
    }
    
    public function aggiungiAlCarrello(EBiglietti_Zona $zona_selezionata) {
        $ordine = new EOrdine();
        $ordine->addBigl($zona_selezionata);

    }

    public function rimuoviDalCarrello() {

    }
    
    public function confermaPagamento() {
        
    }
}



