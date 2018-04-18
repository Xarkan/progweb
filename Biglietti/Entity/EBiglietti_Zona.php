<?php


class EBiglietti_Zona {
    
    //attributi
    private $evento;
    private $zona;
    private $prezzo;
    
    //metodi
    public function __construct($evento, $zona, $prezzo) {
        $this->evento = $evento;
        $this->zona = $zona;
        $this->prezzo = $prezzo;
    }
    public function getEvento() {
        return $this->evento;
    }

    public function getZona() {
        return $this->zona;
    }

    public function getPrezzo() {
        return $this->prezzo;
    }

    public function setEvento($evento) {
        $this->evento = $evento;
    }

    public function setZona($zona) {
        $this->zona = $zona;
    }

    public function setPrezzo($prezzo) {
        $this->prezzo = $prezzo;
    }



}
