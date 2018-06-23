<?php

class FBiglietto extends FDBmanager{
    
    public function __construct() {
        parent::__construct();   
    }
    
    public function lockbiglietto($num_bigl) {
            $sql = "SELECT * FROM biglietto WHERE codb = ".$num_bigl." FOR UPDATE";
            $this->connection->query($sql);        
    }
    
    public function updateBiglietti(EOrdine $ordine) { 

        $sessione = USingleton::getInstance('USession');
        $posti = $sessione->recupera_valore('posti');
        
        $updated = true;
        for ($i = 0; $i < count($ordine->getItems()); $i++) {
            $num_bigl = $result = $this->recuperoId($ordine);
            $this->lockbiglietto($num_bigl);
            $sql = "UPDATE biglietto SET codo=".$ordine->getId().","     //codo mail fila posto
                ." mail=".$this->connection->quote($ordine->getUtente()->getMail()).","
                ." fila=".$this->connection->quote($posti[$i]->getFila()).","
                ." posto=".$this->connection->quote($posti[$i]->getPosto()). " WHERE codb=".$result;    
        $affected_rows = $this->connection->exec($sql);
        if(!$affected_rows > 0) {
            $updated = false;
        }
        //echo "updatebiglietti->".$sql;
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
    
    public function storeBiglietto(EBiglietto $biglietto) {
        $indirizzo = $biglietto->getEvento()->getEventoSpecifico(0)->getLuogo()->getCitta().", ".$evento->getLuogo()->getStruttura();
        $sql = "INSERT INTO biglietto (code,evento,data_evento,zona,indirizzo)"
                . "VALUES (".$this->connection->quote($code).","
                .$this->connection->quote($biglietto->getEvento()->getNome()).","
                . $this->connection->quote($biglietto->getEvento()->getEventoSingolo(0)->getData()).","
                . $this->connection->quote($biglietto->getEvento()->getEventoSingolo(0)->selezionaPartecipazione(0)->getZona()).","
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
    
    public function recuperoId(EOrdine $ordine) {
        
        $part = $ordine->getItems();
        
        $luogo = $ordine->getEvento()->getLuogo();
        $citta = $luogo->getCitta();
        $struttura = $luogo->getStruttura();
        $indirizzo = $citta.", ".$struttura;
        
        $query_id = "SELECT min(codb) FROM biglietto  WHERE code=".$ordine->getCode()." AND zona="
                .$this->connection->quote($part[0]->getZona()->getNome())." AND indirizzo="
                .$this->connection->quote($indirizzo)." AND data_evento="
                .$this->connection->quote($ordine->getEvento()->getData())." AND mail IS NULL";       
        $result = $this->connection->query($query_id);       
        $rows = $result->fetchAll();
        return $rows[0][0];
                
    }
    
    public function loadPostiDisp(EOrdine $ordine) {
        $citta = $ordine->getEvento()->getLuogo()->getCitta();
        $struttura = $ordine->getEvento()->getLuogo()->getStruttura();
        $indirizzo = $citta.", ".$struttura;
        $sql2 = "SELECT max(fila) FROM biglietto WHERE "
                ."code=".$ordine->getCode()." AND "
                ."data_evento=".$this->connection->quote($ordine->getEvento()->getData())." AND "
                ."indirizzo=".$this->connection->quote($indirizzo)." AND "
                ."zona=".$this->connection->quote($ordine->getItems()[0]->getZona()->getNome());
        
        $sql1 = "SELECT fila, max(posto) AS posto FROM biglietto WHERE "
                ."code=".$ordine->getCode()." AND "
                ."data_evento=".$this->connection->quote($ordine->getEvento()->getData())." AND "
                ."indirizzo=".$this->connection->quote($indirizzo)." AND "
                ."zona=".$this->connection->quote($ordine->getItems()[0]->getZona()->getNome())." AND "
                ."fila IN (".$sql2.")";
        
        
        $result = $this->connection->query($sql1);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        
        return $rows;
        
    }
}