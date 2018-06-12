<?php

class FUtente_Reg extends FDBmanager {
    
    function __construct() {
        parent::__construct();
        
    }
    
    public function existutente(EUtente_Reg $object) {
        $sql = "SELECT mail FROM utente_r WHERE mail = ".$this->connection->quote($object->getMail());
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll();
        return count($rows) > 0;

    }

    public function loadutente(EUtente_Reg $object) {
        $sql = "SELECT psw FROM utente_r WHERE mail = ".$this->connection->quote($object->getMail());
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_COLUMN, 0);
        return $rows;
    }

    public function storeutente(EUtente_Reg $object) {
        $nome = $object->getNome();
        $cognome = $object->getCognome();
        $string = $nome." ".$cognome;
        $sql = "INSERT INTO utente_r VALUES ("
                .$this->connection->quote($object->getMail()).","
                .$this->connection->quote(md5($object->getPassword())).","
                .$this->connection->quote($string).")";
        $affected_rows = $this->connection->exec($sql);
        return $affected_rows > 0 ;
    }
    
    public function updateutente($object) {
        $sql = "UPDATE utente_r SET psw = "
                .$this->connection->quote($object->getPassword())." WHERE mail = "
                .$this->connection->quote($object->getMail());
        $affected_rows = $this->connection->exec($sql);
        return $affected_rows > 0;
    }

    public function deleteutente(EUtente_Reg $object) {
        $sql = "DELETE FROM utente_r WHERE mail = "
                .$this->connection->quote($object->getMail());
        $affected_rows = $this->connection->exec($sql);
        var_dump($this->connection);
        return $affected_rows > 0 ;
    }

}