<?php


class EPartita extends EEventoSpecifico{
    
    //attributi
    private $casa;
    private $ospite;		//????
    
    //metodi
    public function __construct($luogo,$data,$partecipazioni,$casa,$ospite) {
        parent::__construct($luogo, $data,$partecipazioni);
	$this->casa = $casa;
	$this->ospite = $ospite;
    }
}
