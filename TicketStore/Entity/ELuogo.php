<?php

class ELuogo {

    //attributi
    public $citta;
    public $struttura;
    public $zone = []; //array(Zona)

	//metodi
    public function __construct($città, $struttura, $zone = null) {
        $this->citta = $città;
        $this->struttura = $struttura;
        $this->zone = $zone;
    }
    function getCitta() {
        return $this->citta;
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

    function setStruttura($struttura) {
        $this->struttura = $struttura;
    }

    function setZone($zone) {
        $this->zone = $zone;
    }

    

}