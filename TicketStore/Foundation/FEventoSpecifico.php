<?php

class FEventospecifico extends FDBmanager {
    
    public function __construct() {
        parent::__construct();
        
    }

    public function existEventoSpec(EEventoSpecifico $evento) {
        $indirizzo = $evento->getLuogo()->getCitta().", ".$evento->getLuogo()->getStruttura();
        $sql = "SELECT * FROM evento_spec WHERE data_evento = ? AND indirizzo = ?";
        $statement = $this->connection->prepare($sql);
        $statement->bindparam(1,$evento->getData());
        $statement->bindparam(2,$indirizzo);
        $statement->execute();
        
        $rows = $statement->fetchAll(PDO::FETCH_COLUMN,0);
        return count($rows) > 0;
    }
    
    public function loadTipo($id) {
        $sql = "SELECT tipo FROM evento_spec WHERE code = ".$id;
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        return $rows[0];
    }
    
    
    public function loadEventoSp($cod_e,$data) {
        $sql = "SELECT * FROM evento_spec WHERE code=".$cod_e
                ." AND data_evento=".$this->connection->quote($data);
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
    
    public function loadEventiSp($cod_e) {
        $sql = "SELECT * FROM evento_spec WHERE code=".$cod_e;
                
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
    public function storeEventoSpec(EEvento $evento, $i = 0) {
    $null = NULL;
    $sql = "INSERT INTO evento_spec VALUES (?,?,?,?,?,?,?,?)"; 
    $statement = $this->connection->prepare($sql);
    
    $eventoSpecifico = $evento->getEventoSingolo($i);
    $indirizzo = $eventoSpecifico->getLuogo()->getCitta().", ".$eventoSpecifico->getLuogo()->getStruttura();
    $tipo = str_replace("E","",get_class($eventoSpecifico));
    
    $statement->bindParam(1,$evento->getId());
    $statement->bindParam(2,$eventoSpecifico->getData());
    $statement->bindParam(3,$indirizzo);
    $statement->bindParam(4, $tipo);
    if($eventoSpecifico instanceof EPartita) {
        $statement->bindParam(5,$eventoSpecifico->getCasa());
        $statement->bindParam(6,$eventoSpecifico->getOspite());
        $statement->bindParam(7,$null);
        $statement->bindParam(8,$null);
    }
    if($eventoSpecifico instanceof ESpettacolo) {
        $statement->bindParam(5,$null);
        $statement->bindParam(6,$null);
        $statement->bindParam(7,$eventoSpecifico->getCompagnia());
        $statement->bindParam(8,$null);
    }
    if($eventoSpecifico instanceof EConcerto) {
        $statement->bindParam(5,$null);
        $statement->bindParam(6,$null);
        $statement->bindParam(7,$null);
        $statement->bindParam(8,$eventoSpecifico->getArtista());
    }
    $result = $statement->execute();
    
    return $result;
        
    }
    public function storeEventoSpec_Mirror(EEvento $evento, $i = 0) {
    $null = NULL;
    $sql = "INSERT INTO evento_spec_mirror VALUES (?,?,?,?,?,?,?,?,?)"; 
    $statement = $this->connection->prepare($sql);
    
    $eventoSpecifico = $evento->getEventoSingolo($i);
    $indirizzo = $eventoSpecifico->getLuogo()->getCitta().", ".$eventoSpecifico->getLuogo()->getStruttura();
    
    $tipo = str_replace("E","",get_class($eventoSpecifico));
    
    $statement->bindParam(1,$evento->getNome());
    $statement->bindParam(2,$evento->getId());
    $statement->bindParam(3,$eventoSpecifico->getData());
    $statement->bindParam(4,$indirizzo);
    $statement->bindParam(5,$tipo);
    if($eventoSpecifico instanceof EPartita) {
        $statement->bindParam(6,$eventoSpecifico->getCasa());
        $statement->bindParam(7,$eventoSpecifico->getOspite());
        $statement->bindParam(8,$null);
        $statement->bindParam(9,$null);
    }
    if($eventoSpecifico instanceof ESpettacolo) {
        $statement->bindParam(6,$null);
        $statement->bindParam(7,$null);
        $statement->bindParam(8,$eventoSpecifico->getCompagnia());
        $statement->bindParam(9,$null);
    }
    if($eventoSpecifico instanceof EConcerto) {
        $statement->bindParam(6,$null);
        $statement->bindParam(7,$null);
        $statement->bindParam(8,$null);
        $statement->bindParam(9,$eventoSpecifico->getArtista());
    }
    $result = $statement->execute();
    
    return $result;
    }
    
    
    public function delete_EventoSpecifico(EEvento $evento,$i=0) {
    $sql = "DELETE FROM evento_spec WHERE code = ".$this->connection->quote($evento->getId())
          ."AND data_evento = ".$this->connection->quote($evento->getEventoSingolo($i)->getData());
    $result = $this->connection->exec($sql);
    
    return $result > 0;
    
}

    public function delete_EventoSpecificoMirror(EEvento $evento,$i=0) {
    $sql = "DELETE FROM evento_spec_mirror WHERE code = ".$this->connection->quote($evento->getId())
          ."AND data_evento = ".$this->connection->quote($evento->getEventoSingolo($i)->getData());
    $result = $this->connection->exec($sql);
    
    return $result > 0;
    
    }
    
}