<?php

class FUtente_Reg extends FDBmanager {
    
    function __construct() {
        parent::__construct();
        
    }
    
    public function existutente(EUtente_Reg $object) {
        $sql = "SELECT mail FROM utente_r WHERE mail = ? ";
        $statement = $this->connection->prepare($sql);
        $statement->bindparam(1,$mail);
        $mail = $object->getMail();
        $statement->execute();
        $rows = $statement->fetchAll();
        return count($rows) > 0;

    }

    public function loadutente(EUtente_Reg $object) {
        $sql = "SELECT * FROM utente_r WHERE mail = ? ";
        $statement = $this->connection->prepare($sql);
        $statement->bindparam(1,$mail);
        $mail = $object->getMail();
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $rows;
    }

    public function storeutente(EUtente_Reg $object) {
        $nome = $object->getNome();
        $cognome = $object->getCognome();
        $sql = "INSERT INTO utente_r VALUES (?,?,?)";
        $statement = $this->connection->prepare($sql);
        
        $statement->bindparam(1,$mail);        
        $statement->bindparam(2,$psw);
        $statement->bindparam(3,$string);
        $mail = $object->getMail();
        $psw = md5($object->getPassword());
        $string = $nome." ".$cognome;
        
        $result = $statement->execute();
        
        return $result > 0 ;
    }
    

    public function deleteutente(EUtente_Reg $object) {
        $sql = "DELETE FROM utente_r WHERE mail = "
                .$this->connection->quote($object->getMail());
        $affected_rows = $this->connection->exec($sql);
        return $affected_rows > 0 ;
    }

}