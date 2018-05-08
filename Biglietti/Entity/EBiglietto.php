<?php


class EBiglietto {
    
    //attributes
    private $codice;
    private $evento;
    private $utente;
    private $zona;
    private $posto;
    
    //methods
    public function __construct($codice, $evento, $utente, $zona, $posto) {
        $this->codice = $codice;
        $this->evento = $evento;
        $this->utente = $utente;
        $this->zona = $zona;
        $this->posto = $posto;
    }
    public function getCodice() {
        return $this->codice;
    }

    public function getEvento() {
        return $this->evento;
    }

    public function getUtente() {
        return $this->utente;
    }

    public function getZona() {
        return $this->zona;
    }

    public function getPosto() {
        return $this->posto;
    }

    public function setCodice($codice) {
        $this->codice = $codice;
    }

    public function setEvento($evento) {
        $this->evento = $evento;
    }

    public function setUtente($utente) {
        $this->utente = $utente;
    }

    public function setZona($zona) {
        $this->zona = $zona;
    }

    public function setPosto($posto) {
        $this->posto = $posto;
    }

    public function CreaBiglietto(EOrdine $ord, FDBmanager $dbm){
        
        $rows = $dbm->getConnection()->load($ord);
        for($i = 0;$i < count($rows);$i++) {
            list($cod_evento, $data, $codice, $utente, $zona, $posto) = $rows[$i];
            $lista_zone = $ord->getLista_bigl();
            $evento = $lista_zone[$i]->getEvento();
            $biglietto = new EBiglietto($codice, $evento, $utente, $zona, $posto);
            $array_bigl[$i] = $biglietto;
        }
        echo "creabiglietto->";
        return $array_bigl;
    }    
    

}
