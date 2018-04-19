<?php


abstract class EEvento {
    
    //attributi
    private $codev;
    private $nome;
    private $luogo; //luogo
    private $data;  //DateTime
    private $descrizione; //string per html??
    
    //metodi
    function __construct($nome, $luogo, $data, $descrizione) {
        $this->nome = $nome;
        $this->luogo = $luogo;
        $this->data = $data;
        $this->descrizione = $descrizione;
    }
    
    public function getCodev() {
        return $this->codev;
    }

    public function getNome() {
        return $this->nome;
    }
    public function setNome($param) {
        $this->nome = $param;
    }
    public function getLuogo() {
        return $this->luogo;
    }
    public function setLuogo(Luogo $param) {
        $this->luogo = $param;
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

