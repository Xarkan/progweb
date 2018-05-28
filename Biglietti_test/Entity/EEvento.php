<?php


class EEvento {
    
    //attributi
    private $id; //string 
    private $nome; //string
    private $eventi = []; //EEventoSpecifico 

    public function __construct($id,$nome,$eventi) {
        $this->id = $id;
        $this->nome = $nome;
        $this->eventi = $eventi;
    }
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getEventi() { //oppure si passa l'ordine nell'argomento
        $ordine = USingleton::getInstance('EOrdine');
        $ordine->setNomeEvento($this->nome);
        return $this->eventi;
    }
    
    function getEventoSingolo($index) {
        return $this->eventi[$index];
    }
    


}

