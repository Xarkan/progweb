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
