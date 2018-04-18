<?php


class EPartita extends EEvento{
    
    //attributi
    private $casa;
    private $ospite;
    
    //metodi
    function __construct($casa, $ospite, $nome, $luogo, $data, $descrizione) {
        $this->casa = $casa;
        $this->ospite = $ospite;
        parent::__construct($nome, $luogo, $data, $descrizione);
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
