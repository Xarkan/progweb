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

    
    public function recuperoDati() {
        $sql_e = "SELECT  * FROM evento LIMIT 6";
        $result = $this->connection->query($sql_e);
        $rows_e = $result->fetchAll(PDO::FETCH_ASSOC);
        $z = 0;
               
        //ciclo pere gli eventi specifici
        for ($i = 0; $i < count($rows_e); $i++) { //viene fatto 6 volte
            $sql_es = "SELECT * FROM evento_spec WHERE code = "
                    .$this->connection->quote($rows_e[$i]['code']);
            $result = $this->connection->query($sql_es);
            $rows_es = $result->fetchAll(PDO::FETCH_ASSOC);
              
            
            //ciclo per le partecipazioni
            for ($j = 0; $j < count($rows_es); $j++) {
                $sql_p = "SELECT partecipazione.*, luogo.struttura, zona.capacita "
                        . "FROM partecipazione, luogo, zona WHERE code = "
                        .$this->connection->quote($rows_es[$j]['code'])." AND partecipazione.indirizzo = "
                        .$this->connection->quote($rows_es[$j]['indirizzo'])." AND data_evento = "
                        .$this->connection->quote($rows_es[$j]['data_evento'])
                        ." AND partecipazione.zona = zona.nome AND partecipazione.indirizzo = zona.indirizzo"
                        ." AND partecipazione.indirizzo = luogo.indirizzo";
               
                $resultp = $this->connection->query($sql_p);
                $rows_pz = $resultp->fetchAll(PDO::FETCH_ASSOC);


                $count = count($rows_pz);
                for($k = 0;$k < $count;$k++){
                    $part = new EPartecipazione($rows_pz[$k]['zona'],$rows_pz[$k]['prezzo'],true);
                    $array_part[$k] = $part;
                    list($citta, $via) = explode(", ", $rows_es[$j]['indirizzo']);
                    $luogo = new ELuogo($citta, $via, $rows_pz[$k]['struttura']);
                    }

                $tipo = $rows_es[$j]['tipo'];
                $classe = 'E'.$tipo;
                
                $evento = new $classe($luogo,$rows_es[$j]['data_evento'],$array_part);
                $array_eventi_spec[$j] = $evento;

                unset($array_part);
            }
            $path_img = $rows_e[$i]['path_img']."\\".$rows_e[$i]['nome_img'];
            $tour = new EEvento($rows_e[$i]['code'],$path_img,$rows_e[$i]['nome'], $array_eventi_spec);
            $lista_eventi_generici[$i] = $tour;
            unset($array_eventi_spec);
        
        }
        return $lista_eventi_generici;
      }

}