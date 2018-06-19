<?php

class FBiglietto extends FDBmanager{
    
    public function __construct() {
        parent::__construct();   
    }
    
    public function updateBiglietti(EOrdine $ordine) { 
        $sessione = USingleton::getInstance('USession');
        $posti = $sessione->recupera_valore('posti');

        $part = $ordine->getItems();
        $luogo = $ordine->getEvento()->getLuogo();
        $citta = $luogo->getCitta();
        $struttura = $luogo->getStruttura();
        $indirizzo = $citta.", ".$struttura;
        $updated = true;
        for ($i = 0; $i < count($ordine->getItems()); $i++) {
           
        $sql = "UPDATE biglietto SET codo=".$ordine->getId().","     //codo mail fila posto
                ." mail=".$this->connection->quote($ordine->getUtente()->getMail()).","
                ." fila=".$this->connection->quote($posti[$i]->getFila()).","
                ." posto=".$this->connection->quote($posti[$i]->getPosto()). " WHERE codb= "
                .$this->recuperoId()." AND code=".$ordine->getCode()." AND zona="
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
    
    public function storebiglietto(EBiglietto $biglietto, $code, $indirizzo) {
        $sql = "INSERT INTO biglietto (code,evento,data_evento,zona,indirizzo)"
                . "VALUES (".$this->connection->quote($code).","
                .$this->connection->quote($biglietto->getNomeEvento()).","
                . $this->connection->quote($biglietto->getData()).","
                . $this->connection->quote($biglietto->getZona()).","
                . $this->connection->quote($indirizzo).")";
        $result = $this->connection->exec($sql);
      
        return $result > 0;
        
    }
    
    public function generabiglietti($num, $nome_evento, $data, $zona, $code, $indirizzo) {
        $stored = true;
        for($i = 0;$i < $num && $stored;$i++){
            $biglietto = new EBiglietto($nome_evento, $data, NULL, $zona, NULL);
            $stored = $this->storebiglietto($biglietto,$code,$indirizzo);
            
        }
        return $stored;
    }
    
    public function recuperoId() {
        $query_id = "SELECT min(codb) FROM biglietto WHERE mail IS NULL "; 
        $result = $this->connection->query($query_id);
        $rows = $result->fetchAll();
        return $rows[0][0];
        
        //$ordine->setId($rows[0][0]);
    }
    
    }