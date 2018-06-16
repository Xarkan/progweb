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
        echo "storeordine->";
        return $affected_rows > 0;
    }
    
    public function storeord_part(EOrdine $object) { //tocca settare code dentro ordine (id)
        $query_id = "SELECT LAST_INSERT_ID()"; 
        $result = $this->connection->query($query_id);
        $rows = $result->fetchAll();
        
        $id = $rows[0][0];
        $part = $object->getItems();
        $evento = $object->getEvento();
        $citta = $evento->getLuogo()->getCitta();
        $via = $evento->getLuogo()->getVia();
        $indirizzo = $citta.", ".$via;
        
        $sql = "INSERT INTO ord_part VALUES (".$id.","
                .$this->connection->quote($object->getCode()).","
                .$this->connection->quote($evento->getData()).","
                .$this->connection->quote($part[0]->getZona()->getNome()).","
                .$this->connection->quote($indirizzo).","
                .$this->connection->quote($object->calcolaPrezzo()).")";
        $affected_rows = $this->connection->exec($sql);
        echo "storeord_part->";
        return $affected_rows > 0;
        
    }


}
