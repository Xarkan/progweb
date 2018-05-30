<?php

class EPartecipazione {

    private $zona;      //EZona
    private $prezzo;    //float
    private $disponibilità;//bool
    
    function __construct($zona, $prezzo, $disponibilità = true) {
        $this->zona = $zona;
        $this->prezzo = $prezzo;
        $this->disponibilità = $disponibilità;
    }
    
    public function controllaDisp() {
        if(!$this->zona->getPostiDisp() > 0) {
            $this->disponibilità = false;
        }        
    }
    
    public function getPostoAssegnato() {
        return $this->zone->assegnaPosto();
    }
    
    public function getDisp() {
        return $this->disponibilità;
    }
}