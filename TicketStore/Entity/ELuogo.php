<?php

class ELuogo {

    //attributi
    public $citta;
    public $via;
    public $struttura;
    public $zone = []; //array(Zona)

	//metodi
    public function __construct($città, $via, $struttura, $zone = null) {
        $this->citta = $città;
        $this->via = $via;
        $this->struttura = $struttura;
        $this->zone = $zone;
    }
    function getCitta() {
        return $this->citta;
    }

    function getVia() {
        return $this->via;
    }

    function getStruttura() {
        return $this->struttura;
    }

    function getZone() {
        return $this->zone;
    }

    function setCittà($città) {
        $this->città = $città;
    }

    function setVia($via) {
        $this->via = $via;
    }

    function setStruttura($struttura) {
        $this->struttura = $struttura;
    }

    function setZone($zone) {
        $this->zone = $zone;
    }

    

}