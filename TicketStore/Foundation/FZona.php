<?php


class FZona extends FDBmanager {
    
    public function storeZona(ELuogo $luogo, $i = 0) {
    $indirizzo = $luogo->getCitta().", ".$luogo->getStruttura();
    $sql = "INSERT INTO zona VALUES (?,?,?)";
    $statement = $this->connection->prepare($sql);
    
    $statement->bindParam(1, $luogo->getZonaSingola($i)->getNome());
    $statement->bindParam(2, $indirizzo);
    $statement->bindParam(3, $luogo->getZonaSingola($i)->getCapacita());
    

    $stored = $statement->execute();

    return $stored;
    
}
}
