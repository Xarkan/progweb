<?php


class EConcerto extends EEvento{
    
    //attributi
    private $artista;
    
    //metodi
    function __construct($artista,$nome, $luogo, $data, $descrizione) {
        $this->artista = $artista;
        parent::__construct($nome, $luogo, $data, $descrizione);
    }

    public function getArtista() {
        return $this->artista;
    }
    public function setArtista($param) {
        $this->artista = $param;
    }
}
