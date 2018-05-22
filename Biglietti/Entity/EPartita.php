<?php


class EPartita extends EEvento{
    
    //attributi
    private $casa = "";
    private $ospite = "";
    
    //metodi
    function __construct($cod, $data, $nome, $citta, $struttura, $via) {
        parent::__construct($cod, $data, $nome, $citta, $struttura, $via);

        }

    public function getCasa() {
        return $this->casa;
    }
    public function setCasa($param) {
        $this->casa = $param;
    }
    public function getOspite() {
        return $this->ospite;
    }
    public function setOspite($param) {
        $this->ospite = $param;
    }
}
