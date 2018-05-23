<?php


abstract class EEvento {
    
    //attributi
    private $codev;
    private $nome;
    private $data;
    private $citta;
    private $struttura;
    private $via;
    
    //metodi
    function __construct($codev, $nome, $data) {
        $this->codev = $codev;
        $this->nome = $nome;
        $this->data = $data;
    }
    function getCodev() {
        return $this->codev;
    }

    function getNome() {
        return $this->nome;
    }

    function getData() {
        return $this->data;
    }

    function getCitta() {
        return $this->citta;
    }

    function getStruttura() {
        return $this->struttura;
    }

    function getVia() {
        return $this->via;
    }

    function setCodev($codev) {
        $this->codev = $codev;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setCitta($citta) {
        $this->citta = $citta;
    }

    function setStruttura($struttura) {
        $this->struttura = $struttura;
    }

    function setVia($via) {
        $this->via = $via;
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

