<?php

class EPartecipazione {

    private $zona;      //EZona
    private $prezzo;    //float
    private $disponibilità = true;//bool
    
    function __construct($zona, $prezzo, $disponibilità) {
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