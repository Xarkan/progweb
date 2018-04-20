<?php


abstract class EEvento {
    
    //attributi
    private $codev;
    private $nome;
    private $citta;
    private $struttura;
    private $via;
    private $data;  //DateTime
    private $descrizione; 
    
    //metodi
    function __construct($cod, $nome, $citta, $struttura, $via, $data, $descrizione) {
        $this->codev = $cod;
        $this->nome = $nome;
        $this->citta = $citta;
        $this->struttura = $struttura;
        $this->via = $via;
        $this->data = $data;
        $this->descrizione = $descrizione;
    }
    
    public function getCodev() {
        return $this->codev;
    }
    public function getNome() {
        return $this->nome;
    }
    public function getCitta() {
        return $this->citta;
    }
    public function getStruttura() {
        return $this->struttura;
    }
    public function getVia() {
        return $this->via;
    }
    public function setCitta($param) {
        $this->citta = $param;
    }
    public function setStruttura($param) {
        $this->struttura = $param;
    }
    public function setVia($param) {
        $this->via = $param;
    }   
    public function setNome($param) {
        $this->nome = $param;
    }    
    public function getData() {
        return $this->data;
    }
    public function setData(DateTime $param) {
        $this->data = $param;
    }      
    public function getDescrizione() {
        return $this->descrizione;
    }
    public function setDescrizione($param) {
        $this->descrizione = $param;
    }
}

