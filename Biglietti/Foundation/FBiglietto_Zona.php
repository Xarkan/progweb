<?php

class FBiglietto_Zona extends FDBmanager {
    
    public function __construct() {
        parent::__construct();
        
    }
    
    public function existbiglietto(EBiglietti_Zona $object) {
        $sql = "SELECT codice FROM biglietti WHERE utente IS NULL "
               . "AND cod_evento = ".$this->connection->quote($object->getEvento()->getCodev())
               . "AND data_evento = ".$this->connection->quote($object->getEvento()->getData())
               ." AND zona = ".$this->connection->quote($object->getZona());
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_COLUMN, 0);
        return count($rows);             
    }
    
    public function loadbigliettidisp(EBiglietti_Zona $object) {
        $sql = "SELECT codice FROM biglietti WHERE utente IS NULL "
               . "AND cod_evento = ".$this->connection->quote($object->getEvento()->getCodev())
               . "AND data_evento = ".$this->connection->quote($object->getEvento()->getData())
               ." AND zona = ".$this->connection->quote($object->getZona());
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_COLUMN, 0);
        return $rows;
    }

}
