<?php


class FOrdine extends FDBmanager{
    
    public function __construct() {
        parent::__construct();
        
    }
    
    public function storeordine(EOrdine $object) {
        $sql = "INSERT INTO ordine VALUES ("
                .$this->connection->quote($object->getId()).","
                .$this->connection->quote($object->getUtente()->getMail()).","
                .$this->connection->quote($object->getData()).","
                .$object->calcolaPrezzo().")";
        try {
        $affected_rows = $this->connection->exec($sql);
        echo "storeordine->";
        }
        catch (Exception $e) {
            echo "error".$e->getMessage();
        }
        return $affected_rows > 0;
    }
    
    /*public function storeordine_bigl(EOrdine $object) {    
        $list_zone = $object->getLista_bigl();
        $list_bigl = $this->load($list_zone[0]);
        echo "storeordine_bigl->";
        for($i = 0; $i < count($list_zone); $i++) {
            $sql = "INSERT INTO ordine_biglietto (id_ord, cod_bigl, cod_evento, data_evento) VALUES (" 
                .$this->connection->quote($object->getId()).","
                .$this->connection->quote($list_bigl[$i]).","
                .$this->connection->quote($list_zone[$i]->getEvento()->getCodev()).","
                .$this->connection->quote($list_zone[$i]->getEvento()->getData()).")";
            $affected_rows = $this->connection->exec($sql);
        }
        return $affected_rows > 0;
    }*/

}
