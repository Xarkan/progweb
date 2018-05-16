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
    
    public function mostraZona() {
        
    }
    
    public function aggiungiAlCarrello() {
        
    }
    
    public function confermaPagamento() {
        
    }
}
