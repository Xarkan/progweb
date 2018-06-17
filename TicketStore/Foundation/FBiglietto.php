<?php

class FBiglietto extends FDBmanager{
    
    public function __construct() {
        parent::__construct();   
    }
    
    public function updateBiglietti(EOrdine $ordine) { 
        $sessione = USingleton::getInstance('USession');
        $posti = $sessione->recupera_valore('posti');
        //--------------da controllare---------------
        $query_id = "SELECT LAST_INSERT_ID()"; //FROM ordine
        $result = $this->connection->query($query_id);
        $rows = $result->fetchAll();
        
        $id = $rows[0][0];
        //-------------------------------------------
        $part = $ordine->getItems();
        $luogo = $ordine->getEvento()->getLuogo();
        $citta = $luogo->getCitta();
        $struttura = $luogo->getStruttura();
        $indirizzo = $citta.", ".$struttura;
        $updated = true;
        for ($i = 0; $i < count($ordine->getItems()); $i++) {
           
        $sql = "UPDATE biglietto SET codo=".$id.","     //codo mail fila posto
                ." mail=".$this->connection->quote($ordine->getUtente()->getMail()).","
                ." fila=".$this->connection->quote($posti[$i]->getFila()).","
                ." posto=".$this->connection->quote($posti[$i]->getPosto()). " WHERE code="
                .$this->connection->quote($ordine->getCode())." AND zona="
                .$this->connection->quote($part[$i]->getZona()->getNome())." AND indirizzo="
                .$this->connection->quote($indirizzo)." AND data_evento="
                .$this->connection->quote($ordine->getEvento()->getData());    
        
        $affected_rows = $this->connection->exec($sql);
        if(!$affected_rows > 0) {
            $updated = false;
        }
        }
        return $updated;        
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