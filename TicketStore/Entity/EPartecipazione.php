<?php

class EPartecipazione {

    public $zona;      //EZona
    public $prezzo;    //float
    public $numPosti;  //int
    public $disp;//bool
    
    function __construct($zona, $prezzo, $num = 0, $disp = false) {
        $this->zona = $zona;
        $this->prezzo = $prezzo;
        $this->numPosti = $num;
        $this->disp = $disp;
    }
    
    public function setZona($zona) {
        $this->zona = $zona;
    }
    
    public function getNumPostiDisp() {
        return $this->numPosti;
    }
    
    public function getPostiAssegnati(EOrdine $ordine, $num) {
        return $this->zona->assegnaPosti($ordine, $num);
    }
    
    public function getDisp() {
        return $this->disp;
    }
    
    public function getZona() {
        return $this->zona;
    }
    
    public function getPrezzo() {
        return $this->prezzo;
    }
}