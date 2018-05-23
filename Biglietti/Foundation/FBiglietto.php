<?php

class FBiglietto extends FDBmanager{
    
    public function __construct() {
        parent::__construct();   
    }
    
    public function loadbiglietticomprati($object) {
        $utente = $object->getUtente();
        $nome = $utente->getNome();
        $cognome = $utente->getCognome();
        $string = $nome." ".$cognome;
        $sql = "SELECT biglietti.* FROM biglietti,ordine, ordine_biglietto WHERE biglietti.utente = "
            .$this->connection->quote($string)." AND biglietti.codice = ordine_biglietto.cod_bigl AND "
            ."ordine.id = ".$this->connection->quote($object->getId());
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll();
        
        return $rows;
    }
    
    public function updatebiglietto($codice, $utente){
        $sql = "UPDATE biglietti SET utente = "
                .$this->connection->quote($utente)." WHERE codice = "
                . $this->connection->quote($codice);
        $affected_rows = $this->connection->exec($sql);
        echo "updatebiglietto->";
        return $affected_rows > 0 ;
    }
    

}
