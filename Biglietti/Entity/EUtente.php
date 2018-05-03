<?php

abstract class EUtente {
    
    //attributi
    private $nome;
    private $cognome;
    
    //metodi
    public function __construct($nome, $cognome) {
        $this->nome = $nome;
        $this->cognome = $cognome;
    }
    
    public function getNome() {
        return $this->nome;
    }

    public function getCognome() {
        return $this->cognome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setCognome($cognome) {
        $this->cognome = $cognome;
    }
    public function paga(Eordine $ordine, FDBmanager $dbm){
        if($ordine->getPagato() == false)
        {
            $prezzo = $ordine->calcolaPrezzo($ordine->getLista_bigl());
            //contatta paypal
            $disp = $dbm->exist($ordine);
            if($disp) {
                $ordine->setPagato(true);
            }            
        }
    }


}
