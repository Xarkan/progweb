<?php


class EConcerto extends EEvento{
    
    //attributi
    private $artista ="";
    
    //metodi
    function __construct($cod, $nome, $data) {
        parent::__construct($cod, $nome, $data);

    }

    public function getArtista() {
        return $this->artista;
    }
    public function setArtista($param) {
        $this->artista = $param;
    }
}
