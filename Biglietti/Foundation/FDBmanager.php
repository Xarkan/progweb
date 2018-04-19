<?php

class FDBmanager {
    
    //attributi
    private $connection;
    private $connected;
    
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
    
    public function exist() {
        $sql = "SELECT * FROM evento";
        foreach ($this->connection->query($sql) as $row) {
        print $row['cod_evento'] . "\t";
        print $row['nome'] . "\t";
        print $row['luogo'] . "\t";
        print $row['data_evento'] . "\t";
        print $row['descrizione'] . "\n";
    }
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

