<?php


class EOrdine {
    
    //attributi
    private $id; //string
    private $nomeEvento; //string 
    private $dataAcquisto; //DataTime
    private $utente; //Utente
    private $items = []; //array(Partecipazione)
    private $pagato = false; //bool
    
    //metodi
    public function __construct() {
        
    }
    
    function setPagato() {
        $this->pagato = true;
    }
    
    public function addElementi(EPartecipazione $item, $num) {
        for ($i = 0; $i < $num; $i++) {
            $this->items[$i] = $item;
        }
    }
    
    public function rimuoviElemento() {
        array_pop($this->items);
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

    function setData($data) {
        $this->dataAcquisto = $data;
    }

    function setUtente($utente) {
        $this->utente = $utente;
    }

    function setItems($items) {
        $this->items = $items;
    }




}
