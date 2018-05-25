<?php


abstract class EEvento {
    
    //attributi
    public $codev;
    public $nome;
    public $citta;
    public $struttura;
    public $via;
    public $data;  //DateTime
    public $descrizione = ""; 
    
    //metodi
    function __construct($cod, $data, $nome, $citta, $struttura, $via) {
        $this->codev = $cod;
        $this->data = $data;
        $this->nome = $nome;
        $this->citta = $citta;
        $this->struttura = $struttura;
        $this->via = $via;
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
    
    public function mostraZona() {
        $mng = new FDBmanager();
        $rows = $mng->load($this);
        for($i = 0;$i < count($rows);$i++) {
            list($codev, $data, $zona, $prezzo) = $rows[$i];
            $zone = new EBiglietti_Zona($this, $zona, $prezzo);
            $array_zone[$i] = $zone;
        }
        echo'mostrazona->';
        return $array_zone;
        
    }    
}

