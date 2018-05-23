<?php


class EConcerto extends EEvento{
    
    //attributi
    private $artista ="";
    
    //metodi
    function __construct($cod, $nome, $tipo) {
        parent::__construct($cod, $nome, $tipo);
        //$this->artista = $artista;
    }

    public function getArtista() {
        return $this->artista;
    }
    public function setArtista($param) {
        $this->artista = $param;
    }
}
