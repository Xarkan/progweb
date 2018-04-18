<?php


class ESpettacolo extends EEvento {
    
    //attributi
    private $compagnia;
    
    //metodi
    function __construct($compagnia, $nome, $luogo, $data, $descrizione) {
        $this->compagnia = $compagnia;
        parent::__construct($nome, $luogo, $data, $descrizione);
    }

    public function getCompagnia() {
        return $this->compagnia;
    }
    public function setCompagnia($param) {
        $this->compagnia = $param;
    }
}
