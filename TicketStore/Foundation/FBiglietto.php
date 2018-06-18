<?php

class FBiglietto extends FDBmanager{
    
    public function __construct() {
        parent::__construct();   
    }
    
    public function updateBiglietti(EOrdine $ordine) { 
        $sessione = USingleton::getInstance('USession');
        $posti = $sessione->recupera_valore('posti');
        //--------------da controllare---------------
        /*$query_id = "SELECT codo FROM ordine ORDER BY codo DESC LIMIT 1";
        $result = $this->connection->query($query_id);
        $rows = $result->fetchAll(PDO::FETCH_COLUMN,0);
        
        $id = $rows[0];*/
        //-------------------------------------------
        $part = $ordine->getItems();
        $luogo = $ordine->getEvento()->getLuogo();
        $citta = $luogo->getCitta();
        $via = $luogo->getVia();
        $indirizzo = $citta.", ".$via;
        $updated = true;
        for ($i = 0; $i < count($ordine->getItems()); $i++) {
           
        $sql = "UPDATE biglietto SET codo=".$ordine->getId().","     //codo mail fila posto
                ." mail=".$this->connection->quote($ordine->getUtente()->getMail()).","
                ." fila=".$this->connection->quote($posti[$i]->getFila()).","
                ." posto=".$this->connection->quote($posti[$i]->getPosto()). " WHERE code="
                .$this->connection->quote($ordine->getCode())." AND zona="
                .$this->connection->quote($part[$i]->getZona()->getNome())." AND indirizzo="
                .$this->connection->quote($indirizzo)." AND data_evento="
                .$this->connection->quote($ordine->getEvento()->getData())." AND mail IS NULL";    
        
        $affected_rows = $this->connection->exec($sql);
        if(!$affected_rows > 0) {
            $updated = false;
        }
        //echo "updatebiglietti->";
        }
        
        return $updated;        
    }
    
    
    
    public function loadbiglietticomprati(EOrdine $object) {
        $utente = $object->getUtente();
        //$nome = $utente->getNome();
        //$cognome = $utente->getCognome();
        //$string = $nome." ".$cognome;
        $string = $utente->getMail();
        $sql = "SELECT biglietto.* FROM biglietto,ordine WHERE biglietto.mail ="
                .$this->connection->quote($string)." AND biglietto.codo = ordine.codo AND biglietto.codo=".$object->getId();
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        //echo "loadbiglietticomprati->";
        return $rows;
    }

    public function generabiglietti($num) {
        
        for($i = 0;$i < $num;$i++){
            $biglietto = new EBiglietto($nome, $data, $proprietario, $zona, $posto);
        }
    }
    
    }