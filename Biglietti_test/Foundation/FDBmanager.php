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
    /*if($object instanceof EEventospecifico) {
        $bigl_zona = new FEventospecifico();
        $bigl_disp = $bigl_zona->existbiglietto($object);
        $found = $bigl_disp > 0;
    }*/
    if($object instanceof EUtente) {
        $utente = new FUtente();
        $found = $utente->existutente($object);
    }
return $found;
}   

//---------------------------load methods----------------------------------
    

    
    
    

   
public function load($object) {
        
    /*if($object instanceof EEvento) {
        $evento = new FEvento();
        $result = $evento->loadzona($object);
    }*/
    if($object instanceof EEvento) {
        $evento = new FEventospecifico();
        $result = $evento->loadDataLuogoPrezzo($object);
    }
    /*if($object instanceof EBiglietti_Zona) {
        $bigl_zona = new FBiglietto_Zona();
        $result = $bigl_zona->loadbigliettidisp($object);
    }*/
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
        //$ordine->storeordine_bigl($object);
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
    /*if($object instanceof EOrdine) {
        $biglietto = new FBiglietto();
        $ordine = new FOrdine();
        $list_zone = $object->getLista_bigl();
        $list_bigl = $ordine->load($list_zone[0]);
        $utente = $object->getUtente();
        $nome = $utente->getNome();
        $cognome = $utente->getCognome();
        $full_name = $nome." ".$cognome;
        for($i = 0; $i < count($list_zone); $i++) { //da rivedere 
            $updated = $biglietto->updatebiglietto($list_bigl[$i], $full_name);
        }*/
       
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

/*public function confermaordine(EOrdine $ordine) {
    if($ordine->getPagato()) {
        echo "confermaordine->";
        $stored = $this->store($ordine);
        $updated = $this->update($ordine);

        }
    return $stored && $updated;
}*/




}