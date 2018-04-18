<?php

class ELuogo {
    
    //attributi
    private $città;
    private $struttura;
    private $via;
    
    //metodi
    function __construct($città, $struttura, $via) {
        $this->città = $città;
        $this->struttura = $struttura;
        $this->via = $via;
    }

    public function getCittà() {
        return $this->città;
    }

    public function getStruttura() {
        return $this->struttura;
    }

    public function getVia() {
        return $this->via;
    }

    public function setCittà($città) {
        $this->città = $città;
    }

    public function setStruttura($struttura) {
        $this->struttura = $struttura;
    }

    public function setVia($via) {
        $this->via = $via;
    }

}
