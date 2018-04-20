<?php


class EConcerto extends EEvento{
    
    //attributi
    private $artista;
    
    //metodi
    function __construct($cod, $nome, $citta, $struttura, $via, $data, $descrizione, $artista) {
        parent::__construct($cod, $nome, $citta, $struttura, $via, $data, $descrizione);
        $this->artista = $artista;
    }

    public function getArtista() {
        return $this->artista;
    }
    public function setArtista($param) {
        $this->artista = $param;
    }
}
