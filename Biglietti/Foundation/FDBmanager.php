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

    public function getConnection() {
        return $this->connection;
    }

    //-------------------------exist methods------------------------------------

    private function existevento(EEvento $object) {
        $sql = "SELECT * FROM evento WHERE cod_evento = ".$this->connection->quote($object->getCodev())
                ." AND data_evento = ".$this->connection->quote($object->getData());
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll();
        return count($rows) > 0;
    }
    private function existbiglietto(EBiglietti_Zona $object) {
        $sql = "SELECT codice FROM biglietti WHERE utente IS NULL "
               . "AND cod_evento = ".$this->connection->quote($object->getEvento()->getCodev())
               . "AND data_evento = ".$this->connection->quote($object->getEvento()->getData())
               ." AND zona = ".$this->connection->quote($object->getZona());
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_COLUMN, 0);
        return count($rows);             
    }
    private function existutente(EUtente_Reg $object) {
        $sql = "SELECT mail FROM utente_r mail = ".$this->connection->quote($object->getMail());
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll();
        return count($rows) > 0;

    }
    public function exist($object) {

            if($object instanceof EEvento) {
                $found = $this->existevento($object);                
            } 
            if($object instanceof EBiglietti_Zona) {
                $bigl_disp = $this->existbiglietto($object);
                $found = $bigl_disp > 0;
            }
            if($object instanceof EUtente_Reg) {
                $found = $this->existutente($object);
            }
        return $found;
    }

    //---------------------------load methods----------------------------------

    private function loadzona(EEvento $object) {
        $sql = "SELECT * FROM biglietti_zona WHERE cod_evento = ".$this->connection->quote($object->getCodev())
              ." AND data_evento = ".$this->connection->quote($object->getData());
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll();
        return $rows;
    }
    private function loadbigliettidisp(EBiglietti_Zona $object) {
        $sql = "SELECT codice FROM biglietti WHERE utente IS NULL "
               . "AND cod_evento = ".$this->connection->quote($object->getEvento()->getCodev())
               . "AND data_evento = ".$this->connection->quote($object->getEvento()->getData())
               ." AND zona = ".$this->connection->quote($object->getZona());
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_COLUMN, 0);
        return $rows;
    }
    private function loadbiglietticomprati($object) {
        $utente = $object->getUtente();
        $nome = $utente->getNome();
        $cognome = $utente->getCognome();
        $string = $nome." ".$cognome;
        $sql = "SELECT biglietti.* FROM biglietti,ordine, ordine_biglietto WHERE biglietti.utente = "
            .$this->connection->quote($string)." AND biglietti.codice = ordine_biglietto.cod_bigl AND "
            ."ordine.id = ".$this->connection->quote($object->getId());
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll();
        return $rows;
    }

    private function loadutente(EUtente $object) {
        $sql = "SELECT mail FROM utente_r mail = ".$this->connection->quote($object->getMail());
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_COLUMN, 0);
        return $rows;
    }
    public function load($object) {
        
            if($object instanceof EEvento) {
                $result = $this->loadzona($object);
            }    
            if($object instanceof EBiglietti_Zona) {
                $result = $this->loadbigliettidisp($object);
            }
            if($object instanceof EUtente_Reg) {
                $result = $this->loadutente($object);
            }
            if($object instanceof EOrdine) {
                $result = $this->loadbiglietticomprati($object);
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

        $affected_rows = $this->connection->exec($sql);
        return $affected_rows > 0 ;
    }

    private function storeutente(EUtente $object) {
        $nome = $object->getNome();
        $cognome = $object->getCognome();
        $string = $nome." ".$cognome;
        $sql = "INSERT INTO utente_r VALUES ("
                .$this->connection->quote($object->getMail()).","
                .$this->connection->quote($object->getPassword()).","
                .$this->connection->quote($string).")";
        $affected_rows = $this->connection->exec($sql);
        return $affected_rows > 0 ;
    }

    private function storeordine(EOrdine $object) {
        $sql = "INSERT INTO ordine VALUES ("
                .$this->connection->quote($object->getId()).","
                .$this->connection->quote($object->getUtente()->getMail()).","
                .$this->connection->quote($object->getData()).","
                .$object->calcolaPrezzo().")";
        try {
        $affected_rows = $this->connection->exec($sql);
        echo "storeordine->";
        }
        catch (Exception $e) {
            echo "error".$e->getMessage();
        }
        return $affected_rows > 0;
    }
    private function storeordine_bigl(EOrdine $object) {    
        $list_zone = $object->getLista_bigl();
        $list_bigl = $this->load($list_zone[0]);
        echo "storeordine_bigl->";
        for($i = 0; $i < count($list_zone); $i++) {
            $sql = "INSERT INTO ordine_biglietto (id_ord, cod_bigl, cod_evento, data_evento) VALUES (" 
                .$this->connection->quote($object->getId()).","
                .$this->connection->quote($list_bigl[$i]).","
                .$this->connection->quote($list_zone[$i]->getEvento()->getCodev()).","
                .$this->connection->quote($list_zone[$i]->getEvento()->getData()).")";
            $affected_rows = $this->connection->exec($sql);
        }
        return $affected_rows > 0;
    }

    public function store($object) {

            if($object instanceof EEvento) {
                $stored = $this->storeevento($object);
            }
            if($object instanceof EUtente_Reg) {
                $stored = $this->storeutente($object);
            }
            if($object instanceof EOrdine) {
                $stored = $this->storeordine($object);
                $this->storeordine_bigl($object);
            }
        return $stored;
    }

    //-----------------------------update methods-------------------------------

    private function updateevento($object) {
        
    }

    private function updateutente($object) {
        $sql = "UPDATE utente_r SET psw = "
                .$this->connection->quote($object->getPassword())." WHERE mail = "
                .$this->connection->quote($object->getMail());
        $affected_rows = $this->connection->exec($sql);
        return $affected_rows > 0;
    }
    private function updatebiglietto($codice, $utente){
        $sql = "UPDATE biglietti SET utente = "
                .$this->connection->quote($utente)." WHERE codice = "
                . $this->connection->quote($codice);
        $affected_rows = $this->connection->exec($sql);
        echo "updatebiglietto->";
        return $affected_rows > 0 ;
    }
    public function update($object) {

            if($object instanceof EEvento) {
                $updated = $this->updateevento($object);
            }
            if($object instanceof EUtente_Reg) {
                $updated = $this->updateutente($object);
            }
            if($object instanceof EOrdine) {
                $list_zone = $object->getLista_bigl();
                $list_bigl = $this->load($list_zone[0]);
                $utente = $object->getUtente();
                $nome = $utente->getNome();
                $cognome = $utente->getCognome();
                $full_name = $nome." ".$cognome;
                for($i = 0; $i < count($list_zone); $i++) { //da rivedere 
                    $updated = $this->updatebiglietto($list_bigl[$i], $full_name);
                }
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
                .$this->connection->quote($object->getCodev())
                ." AND data_evento = ".$this->connection->quote($object->getData());
        $affected_rows = $this->connection->exec($sql);
        return $affected_rows > 0 ;
    }

    public function delete($object) {

            if($object instanceof EEvento) {
                $deleted = $this->deleteevento($object);
            }
            if($object instanceof Utente_Reg) {
                $deleted = $this->deleteutente($object);
            }
        return $deleted;
    }

    public function confermaordine(EOrdine $ordine) {
        if($ordine->getPagato()) {
            echo "confermaordine->";
            $stored = $this->store($ordine);
            $updated = $this->update($ordine);

            }
        return $stored && $updated;
    }
    

    public function loadDataLuogoPrezzo(EEvento $evento){
        $sql = "SELECT DISTINCT bz.data_evento,citta,struttura,via,MIN(bz.prezzo)"
              ." FROM evento as e, biglietti_zona as bz"
              ." WHERE e.cod_evento = ". $this->connection->quote($evento->getCodev())
              ." AND e.cod_evento = bz.cod_evento GROUP BY bz.data_evento";
        $reuslt = $this->connection->query($sql);
        $rows = $reuslt->fetchAll();
        echo "DataLuogoPrezzo->";
        return $rows;
    }
}
