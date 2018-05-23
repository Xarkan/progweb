<?php


class ESpettacolo extends EEvento {
    
    //attributi
    private $compagnia = "";
    
    //metodi
    function __construct($cod, $nome, $data) {
        parent::__construct($cod, $nome, $data);

    }

    public function getCompagnia() {
        return $this->compagnia;
    }
    public function setCompagnia($param) {
        $this->compagnia = $param;
    }
}
