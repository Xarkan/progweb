<?php

class FLuogo extends FDBmanager {
    
    public function existLuogo(ELuogo $luogo) {
        $indirizzo = $luogo->getCitta().", ".$luogo->getStruttura();
        $sql = "SELECT indirizzo FROM luogo WHERE indirizzo = ? ";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $indirizzo);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_COLUMN,0);
        
        return count($result) > 0;
   
    }
    
    public function storeLuogo(ELuogo $luogo) {
        $indirizzo = $luogo->getCitta().", ".$luogo->getStruttura();
        $sql = "INSERT INTO luogo VALUES (?)";
        $statement = $this->connection->prepare($sql);
    
        $statement->bindParam(1, $indirizzo);
   
    
        $result = $statement->execute();
        return $result;
    }
}
