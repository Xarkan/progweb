<?php


class EBiglietto {
    
    //attributes
    private $codice = ''; //string
    private $evento; //EEvento
    private $proprietario = ''; //string
    private $posto; //Posto

    
    //methods
    function __construct($evento) {
        $this->evento = $evento;

    }
    function getCodice() {
        return $this->codice;
    }

    function getEvento() {
        return $this->evento;
    }

    function getProprietario() {
        return $this->proprietario;
    }

    function getPosto() {
        return $this->posto;
    }

    function setCodice($codice) {
        $this->codice = $codice;
    }

    function setEvento($evento) {
        $this->evento = $evento;
    }

    function setProprietario($proprietario) {
        $this->proprietario = $proprietario;
    }

    function setPosto($posto) {
        $this->posto = $posto;
    }


}
