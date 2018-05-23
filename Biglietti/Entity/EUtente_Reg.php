<?php


class EUtente_Reg extends EUtente{
    
    //attributi
    private $nome;
    private $cognome;
    private $mail;
    private $password;
    
    //metodi
    public function __construct($nome, $cognome, $mail, $password) {
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->mail = $mail;
        $this->password = $password;
    }
    
    public function paga(EOrdine $ordine){
        
        if($ordine->getPagato() == false)
        {
            $dbm = new FDBmanager();
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
    
    public function getMail() {
        return $this->mail;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

}
