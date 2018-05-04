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
    /*public function db_table($object) {
        $class = get_class($object);
        $tab = substr_replace($class, "", 0, 1);
        return $tab;
    } */

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
            if($object instanceof EOrdine) {
                $list_zone = $object->getLista_bigl();
                $bigl_disp = $this->existbiglietto($list_zone[0]);
                $found = $bigl_disp >= count($list_zone);
                var_dump($list_zone[0]->getZona());
            }
            if($object instanceof EUtente_Reg) {
                $found = $this->existutente($object);
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
    private function loadbigliettidisp(EBiglietti_Zona $object) {
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
        
            if($object instanceof Evento) {
                $result = $this->loadevento($object);
            }    
            if($object instanceof EBiglietti_Zona) {
                $result = $this->loadbigliettidisp($object);
            }
            if($object instanceof EUtente_Reg) {
                $result = $this->loadutente($object);
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
        
        return $affected_rows > 0;
    }
    private function storeordine_bigl($object) {    
        $list_zone = $object->getLista_bigl();
        $list_bigl = $this->load($list_zone[0]);
        $sql_full = "";
        for($i = 0; $i < count($list_zone); $i++) {
            $sql = "INSERT INTO ordine_biglietti VALUES ("
                .$this->connection->quote($object->getId()).","
                .$this->connection->quote($list_bigl[$i]).","
                .$this->connection->quote($list_zone[$i]->getEvento()->getCodev()).");\n";
                $sql_full = $sql_full.$sql;           
        }       
        $this->connection->exec($sql_full);
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
        $sql = "UPDATE evento SET ";
    }

    private function updateutente($object) {

    }
    private function updatebiglietto($id, $utente){
        $sql = "UPDATE biglietti SET utente = " . $utente . "WHERE codice = " . $id;
        $affected_rows = $this->connection->exec($sql);
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
                $string = $nome." ".$cognome;
                $this->updatebiglietto($list_bigl[0], $string);
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
          
            $updated = $this->update($ordine);
            $stored = $this->store($ordine);

            }
        return $stored && $updated;
    }
}
