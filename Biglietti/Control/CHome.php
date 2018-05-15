<?php


class CHome {
    
    //metodi
    public function impostaHome() {
        $fdbm = new FDBmanager();
        //gli passi una stringa con events e ti ridà un array di EEvento
        $results = $fdbm->load("events"); 
        //results è un array del tipo $results[0][nome] = 'Deep Purple', $results[0][foto]=  blob'Deep.jpg' ecc..
        $home = new VHome();
        $home->setDataIntoTemplate('results', $results);
        $home->setTemplate('Home.tpl');
    }
}
