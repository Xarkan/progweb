<?php


class EOrdine {
    
    //attributi
    private $id;
    private $utente;
    private $lista_bigl; //array
    private $data; //DataTime
    private $pagato; //bool
    
    //metodi
    
    public function __construct() {
        $this->id = null;
        $this->utente = null;
        $this->lista_bigl = null;
        $this->data = null;
        $this->pagato = null;
    }
    
    public function addZone(EBiglietti_Zona $zona, $num) {
	for($i = 1; $i <= $num; $i++) {
            $this->addBigl($zona);
	}
}
    
    private function addBigl(EBiglietti_Zona $ebz) {
        $this->lista_bigl[] = $ebz;
    }
    
    private function removeBigl(EBiglietti_Zona $ebz) {
        $key = array_search($ebz, $this->lista_bigl);
        array_splice($this->lista_bigl, $key, 1);
    }
    
    public function calcolaPrezzo() {
        $tot = 0;
        for($i=0; $i<count($this->lista_bigl); $i++) {
            $tot = $tot + $this->lista_bigl[$i]->getPrezzo();
        }
        return $tot;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getUtente() {
        return $this->utente;
    }

    public function getLista_bigl() {
        return $this->lista_bigl;
    }

    public function getData() {
        return $this->data;
    }

    public function getPagato() {
        return $this->pagato;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUtente($utente) {
        $this->utente = $utente;
    }

    public function setLista_bigl($setLista_bigl) {
        $this->lista_bigl = $setLista_bigl;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function setPagato($pagato) {
        $this->pagato = $pagato;
    }
    
    public function CreaBiglietto(EOrdine $ord, FDBmanager $dbm){
        
        $rows = $dbm->load($ord);
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
