<?php

class FBiglietto extends FDBmanager{
    
    public function __construct() {
        parent::__construct();   
    }
    
    public function loadbiglietticomprati($object) {
        $utente = $object->getUtente();
        //$nome = $utente->getNome();
        //$cognome = $utente->getCognome();
        //$string = $nome." ".$cognome;
        $string = $utente->getMail();
        $sql = "SELECT biglietto.* FROM biglietto,ordine WHERE biglietto.mail = $string AND biglietto.codo = ordine.codo";
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll();
        
        return $rows;
    }

    }