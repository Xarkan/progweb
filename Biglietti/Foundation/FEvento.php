<?php


class FEvento extends FDBmanager {
    
    public function __construct() {
        parent::__construct();
        
    }

    
    public function existevento(EEvento $object) {
        $sql = "SELECT * FROM evento WHERE cod_evento = ".$this->connection->quote($object->getCodev())
                ." AND data_evento = ".$this->connection->quote($object->getData());
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll();
        return count($rows) > 0;
    }
    
    public function loadeventi() {
        $sql = "SELECT evento.*, tipo FROM evento, dettaglio_evento "
                . "WHERE evento.cod_evento=dettaglio_evento.cod_evento "
                . "AND evento.data_evento<>dettaglio_evento.data_evento LIMIT 6";
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll();
        return $rows;      
    }
       
    public function loadzona(EEvento $object) {
        $sql = "SELECT * FROM biglietti_zona WHERE cod_evento = ".$this->connection->quote($object->getCodev())
              ." AND data_evento = ".$this->connection->quote($object->getData());
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll();
        
        return $rows;
    }
    
    public function storeevento(EEvento $object) {

        $sql = "INSERT INTO evento "
             . "VALUES ( ".$this->connection->quote($object->getCodev()).","
             .$this->connection->quote($object->getNome()).","
             .$this->connection->quote($object->getCitta()).","
             .$this->connection->quote($object->getStruttura()).","
             .$this->connection->quote($object->getVia()).","
             .$this->connection->quote($object->getData()).","
             .$this->connection->quote($object->getDescrizione()).")";

        $affected_rows = $this->connection->exec($sql);
        return $affected_rows > 0 ;
    }
    
    public function updateevento($object) {
        
    }
    
    private function deleteevento(EEvento $object) {
        $sql = "DELETE FROM evento WHERE cod_evento = "
                .$this->connection->quote($object->getCodev())
                ." AND data_evento = ".$this->connection->quote($object->getData());
        $affected_rows = $this->connection->exec($sql);
        return $affected_rows > 0 ;
    }

}
