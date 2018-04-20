<?php

class FDBmanager {
    
    //attributi
    private $connection;
    private $connected;
    private $table;
    
    //metodi
    public function __construct() {
        $dsn = 'mysql:dbname=DB_biglietti;host=localhost';
        $user = 'root';
        $password = '';

    try {
        $this->connection = new PDO($dsn, $user, $password);
        $this->connected = true;        
    }
    catch (PDOException $e) {
        $this->connected = false;
        echo 'Connection failed: ' . $e->getMessage();
    }
}
    public function db_table($object) {
        $class = get_class($object);
        $tab = substr_replace($class, "", 0, 1);
        return $tab;
    }
    public function existevento($object) {
        $sql = "SELECT * FROM evento WHERE cod_evento = ".$this->connection->quote($object->getCodev());
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll();
        if(count($rows) > 0) {
            $found = true;
            }
    }
    public function existbiglietto($object) {
        $sql = "SELECT codice FROM biglietti WHERE utente = NULL "
               . "AND cod_evento = ".$this->connection->quote($object->getEvento())
               ." AND ".$this->connection->quote($object->getZona());
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll();
        if(count($rows) > 0) {
            $found = true;
        }
        else {
                    //...
        }
    }
    public function existutente($object) {
        $sql = "SELECT mail FROM utente_r mail = ".$this->connection->quote($object->getMail());
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll();
        if(count($rows) > 0) {
            $found = true;
        }
    }
    public function exist($object) {    
        $this->table = $this->db_table($object);
        switch ($this->table) {
            case "Evento" || "Partita" || "Spettacolo" || "Concerto":
                $found = $this->existevento($object);
                break;
            case "Biglietto":
                $found = $this->existbiglietto($object);
                break;
            case "Utente_Reg":
                $found = $this->existutente($object);
                break;                            
        }
        return $found;
    }
    public function loadevento($object) {
        $sql = "SELECT * FROM evento WHERE cod_evento = ".$this->connection->quote($object->getCodev());
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll();
        for($i=0;$i<count($rows);$i++){
            echo $rows[$i];
        }
        if(count($rows) == 0){
            //...                  da gestire con try cath
        }
    }
    public function loadbiglietto($object) {
        $sql = "SELECT codice FROM biglietti WHERE utente = NULL "
               . "AND cod_evento = ".$this->connection->quote($object->getEvento())
               ." AND ".$this->connection->quote($object->getZona());
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll();
        for($i=0;$i<count($rows);$i++){
            echo $rows[$i];
        }
        if(count($rows) == 0){
            //...                  da gestire con try cath
        }
    }
    public function loadutente($object) {
        $sql = "SELECT mail FROM utente_r mail = ".$this->connection->quote($object->getMail());
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll();
        for($i=0;$i<count($rows);$i++){
            echo $rows[$i];
        }
        if(count($rows) == 0){
            //...                  da gestire con try cath
        }
    }
    public function load($object) {
        $this->table = $this->db_table($object);
        switch ($this->table) {
            case "Evento" || "Partita" || "Spettacolo" || "Concerto":
                $this->existevento($object);
                break;
            case "Biglietto":
                $this->existbiglietto($object);
                break;
            case "Utente_Reg":
                $this->existutente($object);
                break;                            
        }
    }
    
    public function store() {
        
    }
    
    public function update() {
        
    }
    
    public function delete() {
        
    }
}

