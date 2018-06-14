<?php


class FEvento extends FDBmanager {
    
    public function __construct() {
        parent::__construct();
        
    }

    
    public function existevento(EEvento $object) {
        $sql = "SELECT * FROM evento WHERE code = ".$this->connection->quote($object->getId());
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll();
        return count($rows) > 0;
    }
    
    public function loadultimoevento() {
        $sql = "SELECT code FROM evento ORDER BY code DESC LIMIT 1";
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_COLUMN,0);
        return $rows;
    }
    
    public function loadeventiHome() {
        $sql = "SELECT  * FROM evento LIMIT 6";
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
        
    }
    
    public function loadEvento($cod_e) {
        $sql = "SELECT * FROM evento WHERE code=".$this->connection->quote($cod_e);
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        
        return $rows;
    }
   

    public function storeevento(EEvento $object) {
        $result = explode("\\",$object->getImg());
        $nome_img = $result[count($result)-1];
        array_pop($result);
        $path = implode('\\', $result);
        $sql = "INSERT INTO evento "
             . "VALUES ( ".$this->connection->quote($object->getId()).","
             .$this->connection->quote($object->getNome()).","
             .$this->connection->quote($path).","
             .$this->connection->quote($nome_img).")";
     echo '<pre>';
     echo $sql;
     echo'<br>';
     //echo $nome_img;
     echo '</pre>';
        $affected_rows = $this->connection->exec($sql);
        return $affected_rows > 0 ;
    }

    public function updateevento($object) {
        
    }
    
    public function deleteevento(EEvento $object) {
        $sql = "DELETE FROM evento WHERE code = "
                .$this->connection->quote($object->getId());
        echo $sql;
        $affected_rows = $this->connection->exec($sql);
        return $affected_rows > 0 ;
    }

}
