<?php


class ESpettacolo extends EEvento {
    
    //attributi
    private $compagnia = "";
    
    //metodi
    function __construct($cod, $nome, $tipo) {
        parent::__construct($cod, $nome, $tipo);
    }

    public function getCompagnia() {
        return $this->compagnia;
    }
    public function setCompagnia($param) {
        $this->compagnia = $param;
    }
}
