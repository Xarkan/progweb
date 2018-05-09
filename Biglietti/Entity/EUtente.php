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
            try {
                $dbm->getConnection()->beginTransaction();
                $list_zone = $ordine->getLista_bigl();
                $disp = $dbm->exist($list_zone[0]);
                if($disp) {
                $ordine->setPagato(true);
                }
                $conferma = $dbm->confermaordine($ordine);
                $dbm->getConnection()->commit();
                return $conferma;
            }
            catch (Exception $e) {
                $dbm->getConnection()->rollBack();
                echo $e->getMessage();
            }
        }
    }
    public function mostraZona(EEvento $evento, FDBmanager $mng) {
        echo "mostraZona->";
        $rows = $mng->load($evento);
        for($i = 0;$i < count($rows);$i++) {
            list($codev, $data, $zona, $prezzo) = $rows[$i];
            $zone = new EBiglietti_Zona($evento, $zona, $prezzo);
            $array_zone[$i] = $zone;
        }
        return $array_zone;
        
    }

}
