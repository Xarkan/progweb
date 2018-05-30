<?php


class ESpettacolo extends EEventoSpecifico {
    
    //attributi
    private $compagnia;
    
    //metodi
    public function __construct($luogo,$data,$partecipazioni,$compagnia = '') {
        parent::__construct($luogo, $data, $partecipazioni);
	$this->compagnia = $compagnia;
	}
}

