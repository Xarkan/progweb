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
}



