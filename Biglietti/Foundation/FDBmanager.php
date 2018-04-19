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
    public function exist($object) {    
        $this->table = $this->db_table($object);
        switch ($this->table) {
            case "Evento" || "Partita" || "Spettacolo" || "Concerto":
                $sql = "SELECT * FROM evento WHERE cod_evento = ".$this->connection->quote($object->getCodev());
                $result = $this->connection->query($sql);
                $rows = $result->fetchAll();
                if(count($rows) > 0) {
                    $found = true;
                }
                break;
            case "Biglietto":
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
                break;
            case "Utente_Reg":
                $sql = "SELECT mail FROM utente_r mail = ".$this->connection->quote($object->getMail());
                $result = $this->connection->query($sql);
                $rows = $result->fetchAll();
                if(count($rows) > 0) {
                    $found = true;
                }
                break;                            
        }
        
        return $found;
    }
    
    public function load() {
        
    }
    
    public function store() {
        
    }
    
    public function update() {
        
    }
    
    public function delete() {
        
    }
}

