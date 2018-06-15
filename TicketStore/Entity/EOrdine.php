<?php


class EOrdine {
    
    //attributi
    public $code; //string code
    public $nomeEvento; //string 
    public $evento; //EEventoSpecifico
    public $dataAcquisto; //DataTime
    public $utente; //Utente
    public $items = []; //array(Partecipazione)
    public $prezzo_tot;
    public $pagato = false; //bool
    
    //metodi
    public function __construct() {
        
    }
    
    function setPagato($bool) {
        $this->pagato = $bool;
    }
    
    public function addElementi(EPartecipazione $item, $num) {
        for ($i = 0; $i < $num; $i++) {
            $this->items[$i] = $item;
        }
    }
    
    public function rimuoviElemento($p) {
        array_splice($this->items,$p,1);
    }
    
    public function creaBiglietti() {
        if($this->pagato) {
            $db = USingleton::getInstance('FDBmanager');
            $db->update($this); //da vedere se così o $this->getUtente()
            $num = count($this->items);
            for ($i = 0; $i < $num; $i++) {
                $biglietto = new EBiglietto();
                //...
            }
        }
    }
    
    function getCode() {
        return $this->code;
    }
    
    function getEvento() {
        return $this->evento;
    }

    function getData() {
        return $this->dataAcquisto;
    }

    function getUtente() {
        return $this->utente;
    }

    function getItems() {
        return $this->items;
    }

    function getPagato() {
        return $this->pagato;
    }

    function setId($id) {
        $this->id = $id;
    }
    
    function setNomeEvento($nome) {
        $this->nomeEvento = $nome;
    }
    
    function setEvento(EEventoSpecifico $evento) {
        $this->evento = $evento;
    }
    
    function setData($data) {
        $this->dataAcquisto = $data;
    }

    function setUtente($utente) {
        $this->utente = $utente;
    }

    function setItems($items) {
        $this->items = $items;
    }
    public function calcolaPrezzo() {
        $tot = 0;
        for($i=0; $i<count($this->getItems); $i++) {
            $tot = $tot + $this->getItems[$i]->getPrezzo();
        }
        $this->prezzo_tot = $tot;
    }




}
