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
    
    public function controllaDisp() {
        if(!$this->zona->getPostiDisp() > 0) {
            $this->disp = false;
        }        
    }
    
    public function getPostoAssegnato() {
        return $this->zone->assegnaPosto();
    }
    
    public function getDisp() {
        return $this->disp;
    }
}