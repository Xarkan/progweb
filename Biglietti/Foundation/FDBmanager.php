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
            return $found;
            }
        else{
            //...
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
            return $found;
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
            return $found;
        }
        else{
            //...
        }
        
    }
    public function exist($object) {    
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
                $this->loadevento($object);
                break;
            case "Biglietto":
                $this->loadbiglietto($object);
                break;
            case "Utente_Reg":
                $this->loadutente($object);
                break;                            
        }
    }
    public function storeevento($object) {
        
        $sql = "INSERT INTO evento "
             . "VALUES ( ".$this->connection->quote($object->getCodev()).","
             .$this->connection->quote($object->getNome()).","
             .$this->connection->quote($object->getCitta()).","
             .$this->connection->quote($object->getStruttura()).","
             .$this->connection->quote($object->getVia()).","
             .$this->connection->quote($object->getData()).","
             .$this->connection->quote($object->getDescrizione()).")";
        
        try
        {
            $this->connection->exec($sql);
            echo "New record created successfully";
        }
        catch(PDOException $e)
        {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    /*public function loadbiglietto($object) {
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
    }*/
    public function store() {
        
    }
    
    public function update() {
        
    }
    
    public function delete() {
        
    }
}

