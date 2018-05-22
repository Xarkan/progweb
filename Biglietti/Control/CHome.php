<?php


class CHome {
    
    //metodi
    public function impostaHome() {
        $fdbm = USingleton::getInstance('FDBmanager');
        $session = USingleton::getInstance('USession');
        //gli passi una stringa con events e ti ridà un array di EEvento
        
        $results = $fdbm->load("events");
        $num_rows = count($results);
        for($i = 0; $i < $num_rows; $i++) {
        	list($cod_evento, $data, $nome, $citta, $struttura, $via, $descrizione, $tipo) = $results[$i];
        	$classe = "E$tipo";
        	$evento = new $classe($cod_evento, $data, $nome, $citta, $struttura, $via);
        	$array_eventi[$i] = $evento;
        }
        $num_eventi = count($array_eventi);
        for ($i = 0; $i < $num_eventi; $i++) {
            $session->imposta_valore($array_eventi[$i]->getCodev(),$array_eventi[$i]);
        }
        
        $home = new VHome();
        $home->setDataIntoTemplate('results', $results);
        $home->setTemplate('Home.tpl');
    }
}
