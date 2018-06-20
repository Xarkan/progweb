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

    if($object instanceof EUtente_Reg) {
        $utente = new FUtente_Reg();
        $found = $utente->existutente($object);
    }
return $found;
}   

public function existluogo($indirizzo) {
    $sql = "SELECT indirizzo FROM luogo WHERE indirizzo = ? ";
    $statement = $this->connection->prepare($sql);
    $statement->bindParam(1, $indirizzo);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_COLUMN,0);
    if(count($result) > 0){
        return true;
    }
    else{
        return false;
    }   
}

public function existzona($nome, $indirizzo) {
    $sql = "SELECT nome FROM zona WHERE nome = ? AND indirizzo = ? ";
    $statement = $this->connection->prepare($sql);
    $statement->bindParam(1, $nome);
    $statement->bindParam(2, $indirizzo);
    $statement->execute();
    $result = $statement->fetchAll();
    if(count($result) > 0){
        return true;
    }
    else{
        return false;
    }   
}
public function exist_es($code,$data){
    $evento_spec = new FEventospecifico();
    $exist = $evento_spec->existeventospec($code, $data);
    return $exist;
    
}
//---------------------------load methods----------------------------------
    

   
public function load($object, $param = '') {
        

    if($object instanceof EEvento) {
        $evento = new FEventospecifico();
        $result = $evento->loadDataLuogoPrezzo($object);
    }
    if($object instanceof EUtente_Reg) {
        $utente = new FUtente_Reg();
        $result = $utente->loadutente($object);
    }
    if($object instanceof EOrdine) {
        if($param == '') {
            $biglietti = new FBiglietto();
            $result = $biglietti->loadbiglietticomprati($object);
        }else{
            if($param == 'posti') {
                $fbigl = new FBiglietto;
                $result = $fbigl->loadPostiDisp($object);
            }
        }
    }
    if(is_string($object)) {
        if($object == "eventi") {
            $evento = new FEvento();
            $result = $evento->loadeventi();
        }else{ 
            if($object == "home") {
                $result = $this->recuperoDati();
            } //allora è un codice di evento
            if($param == '' && $object != "home") { 
                $result = $this->istanziaEvento($object);
            }        
            if($param != '' && $object != "home") {                
                $result = $this->istanziaEventiSp($object,$param);
            }
        }
        
        
    }
return $result;
}

public function loadultimocodice() {
    $evento = new FEvento();
    $codice = $evento->loadultimoevento();
    return $codice;
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
        $fordine = USingleton::getInstance('FOrdine');
        try {           
            $stored1 = $fordine->storeordine($object);
            $stored2 = $fordine->storeord_part($object);
            $stored = $stored1 && $stored2;
        }
        catch (Exception $e) {
            $stored = false;
            echo $e->getMessage();
        }           
    }
return $stored;
}

public function store_bigl($num,$nome_evento,$data,$zona,$code,$indirizzo) {
    $bigl = new FBiglietto();
    $stored = $bigl->generabiglietti($num, $nome_evento, $data, $zona, $code, $indirizzo);
   
    return $stored;
}

public function storeluogo($indirizzo, $struttura) {
    $sql = "INSERT INTO luogo VALUES (?,?)";
    $statement = $this->connection->prepare($sql);
    
    $statement->bindParam(1, $indirizzo);
    $statement->bindParam(2, $struttura);
    
    $result = $statement->execute();
    return $result;
}
public function storezona($nome, $indirizzo, $capacita) {
    $sql = "INSERT INTO zona VALUES (?,?,?)";
    $statement = $this->connection->prepare($sql);
    
    $statement->bindParam(1, $nome);
    $statement->bindParam(2, $indirizzo);
    $statement->bindParam(3, $capacita);
    
    $exist_luogo = $this->existluogo($indirizzo);
    if(!$exist_luogo){
        $struttura = "";
       $stored_luogo = $this->storeluogo($indirizzo, $struttura);
        if($stored_luogo){
            $stored = $statement->execute();
    } 
    }
    else{
        $stored = $statement->execute();
    }
    return $stored;
    
}
public function store_es($codes,$data,$luogo,$tipo,$casa,$ospite,$compagnia,$artista) {
    $evento_spec = new FEventoSpecifico();
    $exist_luogo = $this->existluogo($luogo);
    if(!$exist_luogo){
        $struttura = "";
       $stored_luogo = $this->storeluogo($luogo, $struttura);
        if($stored_luogo){
            $stored = $evento_spec->storeeventospec($codes, $data, $luogo, $tipo, $casa, $ospite, $compagnia, $artista);
    } 
    }
    else{
        $stored = $evento_spec->storeeventospec($codes, $data, $luogo, $tipo, $casa, $ospite, $compagnia, $artista);
    }
    return $stored;
    
}

public function store_partecipazione($codep,$datap,$zona,$indirizzop,$prezzo) {
    $sql = "INSERT INTO partecipazione "
         . "VALUES (".$codep.","
         .$this->connection->quote($datap).","
         .$this->connection->quote($zona).","
         .$this->connection->quote($indirizzop).","
         .$this->connection->quote($prezzo).")";
    echo $sql;
    $stored = $this->connection->exec($sql);
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
    if($object instanceof EOrdine) {
        $fbigl = USingleton::getInstance('FBiglietto');
        $updated = $fbigl->updateBiglietti($object);
    }
       
return $updated;
}

public function update_es($codes,$data,$luogo,$tipo,$casa,$ospite,$compagnia,$artista) {
    $evento_spec = new FEventospecifico();
    $exist = $this->existluogo($luogo);
    if(!$exist){
        $struttura = "";
        
        $stored_luogo = $this->storeluogo($luogo, $struttura);
        if($stored_luogo){
            $updated = $evento_spec->updateeventospec($codes,$data,$luogo,$tipo,$casa,$ospite,$compagnia,$artista);
        }
    }
    else{
        $updated = $evento_spec->updateeventospec($codes,$data,$luogo,$tipo,$casa,$ospite,$compagnia,$artista);
    }
    return $updated;
    
}
public function update_partecipazione($code,$data,$zona,$indirizzo,$prezzo) {
    
    $sql = "UPDATE partecipazione SET zona = ?, indirizzo = ?, prezzo = ?"
         . "WHERE code = ? AND data_evento = ?";
    $statement = $this->connection->prepare($sql);
    $statement->bindParam(1, $zona);
    $statement->bindParam(2, $indirizzo);
    $statement->bindParam(3, $prezzo);
    $statement->bindParam(4, $code);
    $statement->bindParam(5, $data);
    
    $existzona = $this->existzona($zona, $indirizzo);
    $existluogo = $this->existluogo($indirizzo);
    $existeventospec = $this->exist_es($code, $data);
    
    if($existeventospec){
        if($existzona){
            $updated = $statement->execute();
            
        }
        else{
            echo '<script type="text/javascript">
                        alert("Prima di modificare la zona di una partecipazione.Asicurarsi che questa sia presente nella tabella zona.Inserire la zona in questione e riprovare con la modifica")
                        window.location= "/TicketStore/amministratore"
                      </script>'; 
        }
        return $updated;
    }
    else{
        echo '<script type="text/javascript">
                        alert("evento non esistente")
                        window.location= "/TicketStore/amministratore"
                      </script>'; 
                }
    
    
    
}
public function updatezona($nome, $indirizzo, $capacita) {
    $sql = "UPDATE zona SET capacita = ? WHERE nome = ? AND indirizzo = ?";
    $statement = $this->connection->prepare($sql);
    
    $statement->bindParam(1, $capacita);
    $statement->bindParam(2, $nome);
    $statement->bindParam(3, $indirizzo);
    
    $exist_luogo = $this->existluogo($indirizzo);
    $exist_zona = $this->existzona($nome, $indirizzo);
    if($exist_luogo && $exist_zona){
       $updated = $statement->execute();
       return $updated;
    }
    else{
        echo '<script type="text/javascript">
                        alert("nome/indirizzo non presente nel database.Ricontrollare i campi inseriti.")
                        window.location= "/TicketStore/amministratore"
                      </script>'; 
                
    }
    
}

//------------------------------delete methods-----------------------------

    

    
public function delete($object) {

    if($object instanceof EEvento) {
        $evento = new FEvento();
        $deleted = $evento->deleteevento($object);
    }
    if($object instanceof EUtente_Reg) {
        $utente = new FUtente_Reg();
        $deleted = $utente->deleteutente($object);
    }
return $deleted;
}
public function delete_es($codes,$data) {
    $sql = "DELETE FROM evento_spec WHERE code = ".$this->connection->quote($codes)
          ."AND data_evento = ".$this->connection->quote($data);
    $result = $this->connection->exec($sql);
    if($result > 0){
        return true;
    }
    else {
        return false;
    }
}

public function delete_partecipazione($codep,$datap,$zona,$indirizzop,$prezzo) {
    $sql = "DELETE FROM partecipazione WHERE code = ".$this->connection->quote($codep)
            ."AND data_evento = ".$this->connection->quote($datap)
            ."AND zona = ".$this->connection->quote($zona)
            ."AND indirizzo = ".$this->connection->quote($indirizzop)
            ."AND prezzo = ".$this->connection->quote($prezzo);
    $result = $this->connection->exec($sql);
    if($result > 0){
        return true;
    }
    else {
        return false;
    }
             
}
public function deletezona($nome, $indirizzo) {
    $sql = "DELETE FROM zona WHERE nome = ".$this->connection->quote($nome)
          ."AND indirizzo = ".$this->connection->quote($indirizzo);
    $result = $this->connection->exec($sql);
    if($result > 0){
        return true;
    }
    else {
        return false;
    }
}


//------------------------------------------------------------------------------------------------------------
 
      
    public function recuperoDati()  {
        $fevento = USingleton::getInstance('FEvento');
        $result = $fevento->loadeventiHome();
        for ($i = 0; $i < count($result); $i++) {
            $eventi[$i] = $this->istanziaEvento($result[$i]['code']);
        }
        return $eventi;
    }
      
    private function istanziaEvento($code) {
        $fevento = USingleton::getInstance('FEvento');
        $result = $fevento->loadEvento($code);
        $path_img = $result[0]['path_img']."\\".$result[0]['nome_img'];
        $eventi_spec = $this->istanziaEventiSp($code);
        $tour = new EEvento($result[0]['code'],$path_img,$result[0]['nome'], $eventi_spec);
        return $tour;
    }  
    
    private function istanziaEventiSp($code, $data = '') {
        $feventosp = USingleton::getInstance('FEventoSpecifico');
        if($data == '') {
            $result = $feventosp->loadEventiSp($code);
            for ($i = 0; $i < count($result); $i++) {
                $eventi_spec[$i] = $this->getLuogoZonaPart($result[$i]);
            }
        }
        else {
            $result = $feventosp->loadEventoSp($code,$data);
            $eventi_spec = $this->getLuogoZonaPart($result[0]);
        }
        return $eventi_spec;
    }
      
    private function getLuogoZonaPart($boh) { //cambiare boh
        $sql= "SELECT partecipazione.*, zona.capacita "
                ."FROM partecipazione, luogo, zona WHERE code = "
                .$this->connection->quote($boh['code'])." AND partecipazione.indirizzo = "
                .$this->connection->quote($boh['indirizzo'])." AND data_evento = "
                .$this->connection->quote($boh['data_evento'])
                ." AND partecipazione.zona = zona.nome AND partecipazione.indirizzo = zona.indirizzo"
                ." AND partecipazione.indirizzo = luogo.indirizzo";
               
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        
        for($k = 0;$k < count($rows);$k++){
            $zona = new EZona($rows[$k]['zona'], $rows[$k]['capacita']);
            $part = new EPartecipazione($zona,$rows[$k]['prezzo'],true);
            $array_part[$k] = $part;
            list($citta, $struttura) = explode(", ", $boh['indirizzo']);
            $luogo = new ELuogo($citta, $struttura);
        }

        $tipo = $boh['tipo'];
        $classe = 'E'.$tipo;
                
        $evento = new $classe($luogo,$boh['data_evento'],$array_part);
        return $evento;
    }

}