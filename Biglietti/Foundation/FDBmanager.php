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

    public function getConnection() {
        return $this->connection;
    }
    public function db_table($object) {
        $class = get_class($object);
        $tab = substr_replace($class, "", 0, 1);
        return $tab;
    }

    //-------------------------exist methods------------------------------------

    private function existevento(EEvento $object) {
        $sql = "SELECT * FROM evento WHERE cod_evento = ".$this->connection->quote($object->getCodev());
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll();
        return count($rows) > 0;
    }
    private function existbiglietto(EBiglietti_Zona $object) {
        $sql = "SELECT codice FROM biglietti WHERE utente = NULL "
               . "AND cod_evento = ".$this->connection->quote($object->getEvento()->getCodev())
               ." AND ".$this->connection->quote($object->getZona());
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll();
        return count($rows);
    }
    private function existutente($object) {
        $sql = "SELECT mail FROM utente_r mail = ".$this->connection->quote($object->getMail());
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll();
        return count($rows) > 0;

    }
    public function exist($object) {
        $this->table = $this->db_table($object);
        switch ($this->table) {
            case "Evento" || "Partita" || "Spettacolo" || "Concerto":
                $found = $this->existevento($object);
                break;
            case "Ordine":
                $list_zone = $object->getLista_bigl();
                $bigl_disp = $this->existbiglietto($list_zone[0]);
                $found = $bigl_disp >= count($list_zone);
                break;
            case "Utente_Reg":
                $found = $this->existutente($object);
                break;
        }
        return $found;
    }

    //---------------------------load methods----------------------------------

    private function loadevento(EEvento $object) {
        $sql = "SELECT * FROM evento WHERE cod_evento = ".$this->connection->quote($object->getCodev());
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll();
        return $rows;
    }
    private function loadbiglietto(EBiglietti_Zona $object) {
        $sql = "SELECT codice FROM biglietti WHERE utente = NULL "
               . "AND cod_evento = ".$this->connection->quote($object->getEvento()->getCodev())
               ." AND ".$this->connection->quote($object->getZona());
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll();
        return $rows;
    }
    private function loadutente(EUtente $object) {
        $sql = "SELECT mail FROM utente_r mail = ".$this->connection->quote($object->getMail());
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll();
        return $rows;
    }
    public function load($object) {
        $this->table = $this->db_table($object);
        switch ($this->table) {
            case "Evento" || "Partita" || "Spettacolo" || "Concerto":
                $result = $this->loadevento($object);
                break;
            case "Biglietto":
                $result = $this->loadbiglietto();
                break;
            case "Utente_Reg":
                $result = $this->loadutente($object);
                break;
        }
        return $result;
    }

    //----------------------------store methods---------------------------------

    private function storeevento(EEvento $object) {

        $sql = "INSERT INTO evento "
             . "VALUES ( ".$this->connection->quote($object->getCodev()).","
             .$this->connection->quote($object->getNome()).","
             .$this->connection->quote($object->getCitta()).","
             .$this->connection->quote($object->getStruttura()).","
             .$this->connection->quote($object->getVia()).","
             .$this->connection->quote($object->getData()).","
             .$this->connection->quote($object->getDescrizione()).")";
        /*try
        {
            $this->connection->exec($sql);
            echo "New record created successfully";
        }
        catch(PDOException $e)
        {
            echo $sql . "<br>" . $e->getMessage();
        }*/
        $affected_rows = $this->connection->exec($sql);
        return $affected_rows > 0 ;
    }

    private function storeutente(EUtente $object) {
        $sql = "INSERT INTO utente_r VALUES ("
                .$this->connection->quote($object->getMail()).","
                .$this->connection->quote($object->getPassword()).","
                .$this->connection->quote($object->getNome()).","
                .$this->connection->quote($object->getCognome()).")";
        $affected_rows = $this->connection->exec($sql);
        return $affected_rows > 0 ;
    }

    private function storeordine(EOrdine $object) {
        $sql = "INSERT INTO ordine VALUES ("
                .$this->connection->quote($object->getId()).","
                .$this->connection->quote($object->getUtente()->getMail()).","
                .$this->connection->quote($object->getData()).","
                .$this->connection->quote($object->calcolaPrezzo()).")";
        $affected_rows = $this->connection->exec($sql);
        return $affected_rows > 0 ;
    }

    public function store($object) {
        $this->table = $this->db_table($object);
        switch ($this->table) {
            case "Evento" || "Partita" || "Spettacolo" || "Concerto":
                $stored = $this->storeevento($object);
                break;
            case "Utente_Reg":
                $stored = $this->storeutente($object);
                break;
        }
        return $stored;
    }

    //-----------------------------update methods-------------------------------

    private function updateevento($object) {
        $sql = "UPDATE evento SET ";
    }

    private function updateutente($object) {

    }
    public function updatebiglietto($id, $utente){
        $sql = "UPDATE biglietti SET utente = " . $utente . "WHERE codice = " . $id;
        $affected_rows = $this->connection->exec($sql);
        return $affected_rows > 0 ;
    }
    public function update($object) {
        $this->table = $this->db_table($object);
        switch ($this->table) {
            case "Evento" || "Partita" || "Spettacolo" || "Concerto":
                $updated = $this->updateevento($object);
                break;
            case "Utente_Reg":
                $updated = $this->updateutente($object);
                break;
        }
        return $updated;
    }

    //------------------------------delete methods-----------------------------

    private function deleteutente(EUtente_Reg $object) {
        $sql = "DELETE FROM utente_r WHERE mail = "
                .$this->connection->quote($object->getMail());
        $affected_rows = $this->connection->exec($sql);
        return $affected_rows > 0 ;
    }

    private function deleteevento(EEvento $object) {
        $sql = "DELETE FROM evento WHERE cod_evento = "
                .$this->connection->quote($object->getCodev());
        $affected_rows = $this->connection->exec($sql);
        return $affected_rows > 0 ;
    }

    public function delete($object) {
        $this->table = $this->db_table($object);
        switch ($this->table) {
            case "Evento" || "Partita" || "Spettacolo" || "Concerto":
                $deleted = $this->deleteevento($object);
                break;
            case "Utente_Reg":
                $deleted = $this->deleteutente($object);
                break;
        }
        return $deleted;
    }

    public function confermaordine(EOrdine $ordine) {
        if($ordine->getPagato()) {

            $list_zone = $ordine->getLista_bigl();
            $this->storeordine($ordine);
            for($i = 0; $i < count($list_zone); $i++) {
                $list_bigl[$i] = $this->loadbiglietto($list_zone[$i]);
                $this->updatebiglietto($list_bigl[0],$ordine->getUtente());

                $sql = "INSERT INTO ordine_biglietti VALUES ("
                .$this->connection->quote($ordine->getId()).","
                .$this->connection->quote($list_bigl[$i]).","
                .$this->connection->quote($list_zone[$i]->getEvento()->getCodev()).")";

                $affected_rows = $this->connection->exec($sql);
            }
        }
        return $affected_rows > 0;
    }
}
