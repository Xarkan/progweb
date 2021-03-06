<?php

class FPartecipazione extends FDBmanager{
    
    public function storePartecipazione(EEvento $evento, $i = 0, $j = 0) {
        $eventoSpecifico = $evento->getEventoSingolo($i);
        $indirizzo = $eventoSpecifico->getLuogo()->getCitta().", ".$eventoSpecifico->getLuogo()->getStruttura();
        $sql = "INSERT INTO partecipazione "
         . "VALUES (".$evento->getId().","
         .$this->connection->quote($eventoSpecifico->getData()).","
         .$this->connection->quote($eventoSpecifico->selezionePartecipazione($j)->getZona()->getNome()).","
         .$this->connection->quote($indirizzo).","
         .$eventoSpecifico->selezionePartecipazione($j)->getPrezzo().")";
        //echo $sql;
        $stored = $this->connection->exec($sql);
        return $stored;
    }
    
    public function deletePartecipazione(EEvento $evento, $i = 0, $j = 0) {
    $eventoSpecifico = $evento->getEventoSingolo($i);
        $indirizzo = $eventoSpecifico->getLuogo()->getCitta().", ".$eventoSpecifico->getLuogo()->getStruttura();
    $sql = "DELETE FROM partecipazione WHERE code = ".$evento->getId()
            ." AND data_evento = ".$this->connection->quote($eventoSpecifico->getData())
            ." AND zona = ".$this->connection->quote($eventoSpecifico->selezionePartecipazione($j)->getZona()->getNome())
            ." AND indirizzo = ".$this->connection->quote($indirizzo);        
    $result = $this->connection->exec($sql);
    return $result > 0;
             
}
}
