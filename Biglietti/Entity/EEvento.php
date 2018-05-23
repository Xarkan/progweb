<?php


abstract class EEvento {
    
    //attributi
    private $codev;
    private $nome;
    private $tipo; 
    
    //metodi
    function __construct($cod, $nome, $tipo) {
        $this->codev = $cod;
        $this->nome = $nome;
        $this->tipo = $tipo;
    }
    
    function getCodev() {
        return $this->codev;
    }

    function getNome() {
        return $this->nome;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setCodev($codev) {
        $this->codev = $codev;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
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

