<?php

class FDBmanager {

    //attributi
    protected $connection;
    protected $connected;

    //metodi
    public function __construct() {
        include 'Config.php';
        $dsn = 'mysql:dbname='.$config['mysql']['database'].';host='.$config['mysql']['host'];
        $user = $config['mysql']['user'];
        $password = $config['mysql']['password'];

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

    
    
    
public function exist($object) {

    if($object instanceof EEvento) {
        $evento = new FEvento();
        $found = $evento->existevento($object);                
    } 

    if($object instanceof EUtente) {
        $utente = new FUtente();
        $found = $utente->existutente($object);
    }
return $found;
}   

//---------------------------load methods----------------------------------
    

    
    
    

   
public function load($object) {
        

    if($object instanceof EEvento) {
        $evento = new FEventospecifico();
        $result = $evento->loadDataLuogoPrezzo($object);
    }

    if($object instanceof EUtente_Reg) {
        $utente = new FUtente_Reg();
        $result = $utente->loadutente($object);
    }
    if($object instanceof EOrdine) {
        $biglietti = new FBiglietto();
        $result = $biglietti->loadbiglietticomprati($object);
    }
    if($object == "eventi") {
        $evento = new FEvento();
        $result = $evento->loadeventi();
    }
return $result;
}

//----------------------------store methods---------------------------------



public function store($object) {

    if($object instanceof EEvento) {
        $evento = new FEvento();
        $stored = $evento->storeevento($object);
    }
    if($object instanceof EUtente_Reg) {
        $utente = new FUtente_Reg();
        $stored = $utente->storeutente($object);
    }
    if($object instanceof EOrdine) {
        $ordine = new FOrdine();
        $stored = $ordine->storeordine($object);
    }
return $stored;
}

//-----------------------------update methods-------------------------------

    

    
   
public function update($object) {

    if($object instanceof EEvento) {
        $evento = new FEvento();
        $updated = $evento->updateevento($object);
    }
    if($object instanceof EUtente_Reg) {
        $utente = new FUtente_Reg();
        $updated = $utente->updateutente($object);
    }
       
return $updated;
}

//------------------------------delete methods-----------------------------

    

    
public function delete($object) {

    if($object instanceof EEvento) {
        $evento = new FEvento();
        $deleted = $evento->deleteevento($object);
    }
    if($object instanceof Utente_Reg) {
        $deleted = $this->deleteutente($object);
    }
return $deleted;
}



public function recuperadsdDati() {
        $db = USingleton::getInstance('FDBmanager');
        $risultato_eventi = $db->load('eventi'); //6 eventi ( per il codice e il nome)
        //questo sotto gli passi code e ti prende gli ev_spec associati
        $ris_eventi_specifici = $db->loadEventiSpecifici($risultato_eventi[$i]['code']);
        //deve essere ciclato per tutti gli eventi iniziali
        
        //ora servono le partecipazioni
        $partecipazioni = $db->loadPartecipazioni("code","indirizzo","data");
        //ritorna le partecipazioni associate alle chiavi passate
        //va ciclato per tutti gli ev_spec  
    }
    
    public function __recuperoDati() {
        $sql_e = "SELECT  * FROM evento LIMIT 6";
        $result = $this->connection->query($sql_e);
        $rows_e = $result->fetchAll(PDO::FETCH_ASSOC);
        echo 1;
        
        //ciclo pere gli eventi specifici
        for ($i = 0; $i < count($rows_e); $i++) { //viene fatto 6 volte
            $sql_es = "SELECT * FROM evento_spec WHERE code = "
                    .$this->connection->quote($rows_e[$i]['code']);
            $result = $this->connection->query($sql_es);
            $rows_es[$i] = $result->fetchAll(PDO::FETCH_ASSOC);

            
            //ciclo per le partecipazioni
            for ($j = 0; $j < count($rows_es[$i]); $j++) {
                $sql_p = "SELECT * FROM partecipazione WHERE code = "
                        .$this->connection->quote($rows_es[$i][$j]['code'])." AND indirizzo = "
                        .$this->connection->quote($rows_es[$i][$j]['indirizzo'])." AND data_evento = "
                        .$this->connection->quote($rows_es[$i][$j]['data_evento']);
                $resultp = $this->connection->query($sql_p);
                $rows_p[$i][$j] = $resultp->fetchAll(PDO::FETCH_ASSOC);
                
                
                //ciclo per le zone
                for ($k = 0; $k < count($rows_p[$i][$j]); $k++) {  
                   $sql_z = "SELECT * FROM zona WHERE nome = "
                        .$this->connection->quote($rows_p[$i][$j][$k]['zona'])." AND indirizzo = "
                        .$this->connection->quote($rows_p[$i][$j][$k]['indirizzo']);
                    $resultz = $this->connection->query($sql_z);
                    $rows_z[$i][$j][$k] = $resultz->fetchAll(PDO::FETCH_ASSOC);
                    
                }
   
            }

        }
        /*echo "<pre>";
        print_r($rows_es);
        echo "</pre>";
        echo "<pre>";
        print_r($rows_p);
        echo "</pre>";
        echo "<pre>";
        print_r($rows_z);
        echo "</pre>";
        echo "<pre>";
        print_r($zona);
        echo "</pre>";*/
    // print_r($zone);
        
        
    for ($i = 0; $i < count($rows_e); $i++) {
        for ($j = 0; $j < count($rows_es[$i]); $j++) {
            for ($k = 0; $k < count($rows_p[$i][$j]); $k++) {
                
            }
        }
    }
    
  }
    
      public function recuperoDati() {
        $sql_e = "SELECT  * FROM evento LIMIT 6";
        $result = $this->connection->query($sql_e);
        $rows_e = $result->fetchAll(PDO::FETCH_ASSOC);

        
        //ciclo pere gli eventi specifici
        for ($i = 0; $i < count($rows_e); $i++) { //viene fatto 6 volte
            $sql_es = "SELECT * FROM evento_spec WHERE code = "
                    .$this->connection->quote($rows_e[$i]['code']);
            $result = $this->connection->query($sql_es);
            $rows_es = $result->fetchAll(PDO::FETCH_ASSOC);

            
            //ciclo per le partecipazioni
            for ($j = 0; $j < count($rows_es); $j++) {
                $sql_p = "SELECT * FROM partecipazione WHERE code = "
                        .$this->connection->quote($rows_es[$j]['code'])." AND indirizzo = "
                        .$this->connection->quote($rows_es[$j]['indirizzo'])." AND data_evento = "
                        .$this->connection->quote($rows_es[$j]['data_evento']);
                $resultp = $this->connection->query($sql_p);
                $rows_p = $resultp->fetchAll(PDO::FETCH_ASSOC);
       
                for ($k = 0; $k < count($rows_p); $k++) {
                    $sql_z = "SELECT * FROM zona WHERE nome = "
                        .$this->connection->quote($rows_p[$k]['zona'])." AND indirizzo = "
                        .$this->connection->quote($rows_es[$j]['indirizzo']);
                    $resultz = $this->connection->query($sql_z);
                    $rows_z = $resultz->fetchAll(PDO::FETCH_ASSOC);
                    $zona = new EZona($rows_z[0]['nome'], $rows_z[0]['capacita']);
                    $partecipazioni[$j] = new EPartecipazione($zona, $rows_p[$j]['prezzo']);

                }
                echo "<pre>";
                print_r($partecipazioni);
                echo "</pre>";
        
   
            }
            //RewriteCond %(REQUEST_FILENAME) !-f
            //RewriteCond %(REQUEST_FILENAME) !-d
            //RewriteCond %(REQUEST_FILENAME) !.*\.(png|jpg|css|js|html)$
        }
      }

}