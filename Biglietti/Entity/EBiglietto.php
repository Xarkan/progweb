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
    public function generacodice(FDBmanager $connection){

        $pdo = $connection->getConnection();
        $sql = "SELECT MAX(cod_evento) FROM biglietti";
        $result = $pdo->query($sql);
        return $result+1;
    }
    public function CreaBiglietto(FDBmanager $mng, EOrdine $ord){
        $sql = "SELECT * FROM biglietti WHERE utente = ".$ord->getUtente();
        $result = $mng->getConnection()->query($sql);
        $rows = $result->fetchAll();
        for($i = 0;$i < count($rows);$i++){
            list($codice, $evento, $utente, $zona, $posto) = $rows[$i];
            $biglietto = new EBiglietto($codice, $evento, $utente, $zona, $posto);
            $array_bigl[$i] = $biglietto;
        }
        return $array_bigl;
    }

}
