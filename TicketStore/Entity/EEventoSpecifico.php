<?php

abstract class EEventoSpecifico {
	
    //attributi
    public $luogo;   //Luogo
    public $data;    //DateTime
    public $partecipazioni = [];

    public function __construct($luogo,$data,$partecipazioni) {
        $this->luogo = $luogo;
        $this->data = $data;
        $this->partecipazioni = $partecipazioni;
	}
        
    function getLuogo() {
        return $this->luogo;
    }

    function getData() {
        return $this->data;
    }

    function getPartecipazioni() {
        return $this->partecipazioni;
    }
    
    function selezionePartecipazione($index) {
        return $this->partecipazioni[$index];
    }
    
    //ci vuole qualcosa per il controllo della disponibilità
    
    
    
    /*function selezionePartecipazione($index) {
        $length = count($this->partecipazioni);
        for($i = 0; $i < $length; $i++) {
            if($this->partecipazioni[$i]->getDisp()) {
                $opzioniDisp = $this->partecipazioni[$i];
            }
        }
        return $opzioniDisp[$index];
    }*/ 


}