<?php


class EPartita extends EEventoSpecifico{
    
    //attributi
    public $casa;
    public $ospite;		//????
    
    //metodi
    public function __construct($luogo,$data,$partecipazioni,$casa = '',$ospite = '') {
        parent::__construct($luogo, $data,$partecipazioni);
	$this->casa = $casa;
	$this->ospite = $ospite;
    }
    function getCasa() {
        return $this->casa;
    }

    function getOspite() {
        return $this->ospite;
    }


}
