<?php


class FOrdine extends FDBmanager{
    
    public function __construct() {
        parent::__construct();
        
    }
    
    public function storeordine(EOrdine $object) {
        $sql = "INSERT INTO ordine (mail,data_ordine) VALUES ("
                .$this->connection->quote($object->getUtente()->getMail()).","
                .$this->connection->quote($object->getData()).")";

        $affected_rows = $this->connection->exec($sql);
        //echo "storeordine->".$sql;
        return $affected_rows > 0;
    }
    
    public function storeord_part(EOrdine $object) { 
        $this->recuperoId($object);
        $part = $object->getItems();
        $evento = $object->getEvento();
        $citta = $evento->getLuogo()->getCitta();
        $struttura = $evento->getLuogo()->getStruttura();
        $indirizzo = $citta.", ".$struttura;
        
        $sql = "INSERT INTO ord_part VALUES (".$object->getId().","
                .$this->connection->quote($object->getCode()).","
                .$this->connection->quote($evento->getData()).","
                .$this->connection->quote($part[0]->getZona()->getNome()).","
                .$this->connection->quote($indirizzo).","
                .$this->connection->quote($object->getPrezzo()).")";
        $affected_rows = $this->connection->exec($sql);
        //echo "storeord_part->".$sql;
        return $affected_rows > 0;
        
    }
    
    
    public function recuperoId(EOrdine $ordine) {
        $query_id = "SELECT max(codo) FROM ordine"; 
        $result = $this->connection->query($query_id);
        $rows = $result->fetchAll();
        
        $ordine->setId($rows[0][0]);
    }


}
