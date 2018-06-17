<?php

class EPartecipazione {

    public $zona;      //EZona
    public $prezzo;    //float
    public $disp;//bool
    
    function __construct($zona, $prezzo, $disp = true) {
        $this->zona = $zona;
        $this->prezzo = $prezzo;
        $this->disp = $disp;
    }
    
    public function setZona($zona) {
        $this->zona = $zona;
    }
    
    public function controllaDisp() {
        if(!$this->zona->getPostiDisp() > 0) {
            $this->disp = false;
        }        
    }
    
    public function getPostiAssegnati($num) {
        return $this->zona->assegnaPosti($num);
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