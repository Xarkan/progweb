<?php


class FEvento extends FDBmanager {
    
    public function __construct() {
        parent::__construct();
        
    }

    
    public function existevento(EEvento $object) {
        $sql = "SELECT * FROM evento WHERE code = ".$this->connection->quote($object->getId());
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll();
        return count($rows) > 0;
    }

    public function loadeventi() {
        $sql = "SELECT  * FROM evento LIMIT 6";
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll();
        return $rows;
        
    }

    public function storeevento(EEvento $object) {

        $sql = "INSERT INTO evento "
             . "VALUES ( ".$this->connection->quote($object->getId()).","
             .$this->connection->quote($object->getNome()).")";

        $affected_rows = $this->connection->exec($sql);
        return $affected_rows > 0 ;
    }

    public function updateevento($object) {
        
    }
    
    private function deleteevento(EEvento $object) {
        $sql = "DELETE FROM evento WHERE cod_evento = "
                .$this->connection->quote($object->getId());
        $affected_rows = $this->connection->exec($sql);
        return $affected_rows > 0 ;
    }

}
