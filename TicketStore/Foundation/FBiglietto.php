<?php

class FBiglietto extends FDBmanager{
    
    public function __construct() {
        parent::__construct();   
    }
    
    public function updateBiglietti(EOrdine $ordine) { 
        $sessione = USingleton::getInstance('USession');
        $posti = $sessione->recupera_valore('posti');
        //--------------da controllare---------------
        $query_id = "SELECT LAST_INSERT_ID()"; 
        $result = $this->connection->query($query_id);
        $rows = $result->fetchAll();
        
        $id = $rows[0][0];
        //-------------------------------------------
        
        $sql = "UPDATE biglietto SET codo=".$id.","     //codo mail fila posto
                ." mail=".$this->connection->quote($ordine->getUtente()->getMail()).","
                ." fila=".$this->connection->quote($posti[$i]->getFila()).","
                ." posto=".$this->connection->quote($posti[$i]->getPosto()). " WHERE code="
                .$this->connection->quote($ordine->getCode())." AND"
                .$this->connection->quote($ordine->getItems());    //da finire!
        
        $affected_rows = $this->connection->exec($sql);
        return $affected_rows > 0;        
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