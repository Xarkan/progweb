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
        $lista_zone = $evento->mostraZona();//abbiamo un array di oggetti e questo da fastidio a smarty
        for($i = 0;$i<count($lista_zone);$i++){
            $array[$i]['zona'] = $lista_zone[$i]->getZona();
            $array[$i]['prezzo'] = $lista_zone[$i]->getPrezzo();
        }
        var_dump($array);
        $zona = new VZona();
        $zona->setDataIntoTemplate('results',$array);
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



