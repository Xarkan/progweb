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
}
