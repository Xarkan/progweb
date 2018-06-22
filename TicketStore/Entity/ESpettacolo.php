<?php


class ESpettacolo extends EEventoSpecifico {
    
    //attributi
    public $compagnia;
    
    //metodi
    public function __construct($luogo,$data,$partecipazioni,$compagnia) {
        parent::__construct($luogo, $data, $partecipazioni);
	$this->compagnia = $compagnia;
	}
        function getCompagnia() {
            return $this->compagnia;
        }
    
}

