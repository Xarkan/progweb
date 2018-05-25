<?php


class CHome {
    
    //metodi
    public function avviaHome() {
        $home = new VHome();
        $home->setTemplate('Home.tpl');
    }
    public function impostaHome() {
        $fdbm = USingleton::getInstance('FDBmanager');

        
        $results = $fdbm->load("events");
        $num_rows = count($results);
        for($i = 0; $i < $num_rows; $i++) {
        	list($cod_evento, $data, $nome, $citta, $struttura, $via, $descrizione, $tipo) = $results[$i];
        	$classe = "E$tipo";
        	$evento = new $classe($cod_evento, $data, $nome, $citta, $struttura, $via);
        	$array_eventi[$i] = $evento;
        }
        /*$num_eventi = count($array_eventi);
        for ($i = 0; $i < $num_eventi; $i++) {
            $session->imposta_valore("evento".$array_eventi[$i]->getCodev(),$array_eventi[$i]);
        }*/
        $json = json_encode($array_eventi);
        echo $json;
    }
}
