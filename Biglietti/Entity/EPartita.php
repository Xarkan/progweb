<?php


class EPartita extends EEvento{
    
    //attributi
    private $casa;
    private $ospite;
    
    //metodi
    function __construct($cod, $nome, $citta, $struttura, $via, $data, $descrizione, $casa, $ospite) {
        parent::__construct($cod, $nome, $citta, $struttura, $via, $data, $descrizione);
        $this->casa = $casa;
        $this->ospite = $ospite;
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
