<?php

class FEventospecifico extends FDBmanager {
    
    public function __construct() {
        parent::__construct();
        
    }


public function loadDataLuogoPrezzo(EEvento $evento){
    $sql = "SELECT  *"
          ." FROM evento_spec AS es "
          ." WHERE es.cod_evento = ". $this->connection->quote($evento->getCodev());
    $reuslt = $this->connection->query($sql);
    $rows = $reuslt->fetchAll();
    
    return $rows;
}

}