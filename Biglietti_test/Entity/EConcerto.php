<?php


class EConcerto extends EEventoSpecifico{
    
    //attributi
    private $artista;
    
    //metodi
    public function __construct($luogo,$data,$partecipazioni,$artista = '') {
        parent::__construct($luogo, $data,$partecipazioni);
    	$this->artista = $artista;
    } 
}
