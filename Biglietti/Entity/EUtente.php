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
    public function paga(EOrdine $ordine, FDBmanager $dbm){
        if($ordine->getPagato() == false)
        {
            $prezzo = $ordine->calcolaPrezzo($ordine->getLista_bigl());
            //contatta paypal
            $disp = $dbm->exist($ordine);
            if($disp) {
                $ordine->setPagato(true);
            }
            $conferma = $dbm->confermaordine($ordine);
            return $conferma;
        }
    }
    public function mostraZona(EEvento $evento, FDBmanager $mng) {
        $sql = "SELECT * FROM biglietti_zona WHERE cod_evento = " . $evento->getCodev()
              ." AND data_evento = ".$evento->getData();
        $result = $mng->getConnection()->query($sql);
        $rows = $result->fetchAll();
        for($i = 0;$i < count($rows);$i++){
            list($codev, $data, $zona, $prezzo) = $rows[$i];
            $zone = new EBiglietti_Zona($evento, $zona, $prezzo);
            $array_zone[$i] = $zone;
        }
        return $array_zone;
        
    }

}
