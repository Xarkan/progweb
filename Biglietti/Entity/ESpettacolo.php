<?php


class ESpettacolo extends EEvento {
    
    //attributi
    private $compagnia;
    
    //metodi
    function __construct($cod, $nome, $luogo, $data, $descrizione, $compagnia) {
        parent::__construct($cod, $nome, $luogo, $data, $descrizione);
        $this->compagnia = $compagnia;
    }

    public function getCompagnia() {
        return $this->compagnia;
    }
    public function setCompagnia($param) {
        $this->compagnia = $param;
    }
}
