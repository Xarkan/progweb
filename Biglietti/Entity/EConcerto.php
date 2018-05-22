<?php


class EConcerto extends EEvento{
    
    //attributi
    private $artista ="";
    
    //metodi
    function __construct($cod, $data, $nome, $citta, $struttura, $via) {
        parent::__construct($cod, $data, $nome, $citta, $struttura, $via);
        $this->artista = $artista;
    }

    public function getArtista() {
        return $this->artista;
    }
    public function setArtista($param) {
        $this->artista = $param;
    }
}
