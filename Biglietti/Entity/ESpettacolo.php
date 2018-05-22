<?php


class ESpettacolo extends EEvento {
    
    //attributi
    private $compagnia = "";
    
    //metodi
    function __construct($cod, $data, $nome, $citta, $struttura, $via) {
        parent::__construct($cod, $data, $nome, $citta, $struttura, $via);
    }

    public function getCompagnia() {
        return $this->compagnia;
    }
    public function setCompagnia($param) {
        $this->compagnia = $param;
    }
}
