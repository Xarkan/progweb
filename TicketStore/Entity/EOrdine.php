<?php


class EOrdine {
    
    //attributi
    private $id; //string
    private $nomeEvento; //string 
    private $evento; //EEventoSpecifico
    private $dataAcquisto; //DataTime
    private $utente; //Utente
    private $items = []; //array(Partecipazione)
    private $pagato = false; //bool
    
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
    
    public function rimuoviElemento() {
        array_pop($this->items);
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
    
    function getId() {
        return $this->id;
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
        return $tot;
    }




}
