<?php


class EBiglietto {
    
    //attributes
    private $codice = ''; //string
    private $nomeEvento; //string
    private $data; //DateTime
    private $proprietario; //string
    private $zona; //string
    private $posto; //Posto

    
    //methods
    function __construct($nome, $data, $proprietario, $zona, $posto) {
        $this->nomeEvento = $nome;
        $this->data = $data;
        $this->proprietario = $proprietario;
        $this->zona = $zona;
        $this->posto = $posto;
    }
    function getCodice() {
        return $this->codice;
    }

    function getNomeEvento() {
        return $this->nomeEvento;
    }

    function getData() {
        return $this->data;
    }

    function getProprietario() {
        return $this->proprietario;
    }

    function getZona() {
        return $this->zona;
    }

    function getPosto() {
        return $this->posto;
    }

    function setCodice($codice) {
        $this->codice = $codice;
    }

    function setNomeEvento($nomeEvento) {
        $this->nomeEvento = $nomeEvento;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setProprietario($proprietario) {
        $this->proprietario = $proprietario;
    }

    function setZona($zona) {
        $this->zona = $zona;
    }

    function setPosto($posto) {
        $this->posto = $posto;
    }






}
