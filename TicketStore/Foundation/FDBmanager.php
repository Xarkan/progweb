
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

//----------------------------store methods---------------------------------



public function store($object) {

    if($object instanceof EEvento) {
        echo "pipposo";
        $fevento = USingleton::getInstance('FEvento');
        $fevsp = USingleton::getInstance('FEventoSpecifico');
        $fluogo = USingleton::getInstance('FLuogo');
        $fzona = USingleton::getInstance('FZona');
        $fpart = USingleton::getInstance('FPartecipazione');
        $eventoSpecifico = $object->getEventoSingolo(0);

        if(!$fevento->existEvento($object)) {
            $fevento->storeEvento($object);
        }
        
        $exist_luogo = $fluogo->existLuogo($eventoSpecifico->getLuogo());
        if(!$exist_luogo){
            $stored_luogo = $fluogo->storeLuogo($eventoSpecifico->getLuogo());
            if($stored_luogo){
                $stored_zona = $fzona->storeZona($eventoSpecifico->getLuogo());
                if($stored_zona) {
                        $stored_evsp = $fevsp->storeEventoSpec($object);
                        $stored_mirror = $fevsp->storeEventoSpec_Mirror($object);                   
                        if($stored_evsp && $stored_mirror) {                   
                            $stored = $fpart->storePartecipazione($object);
                        }
                }        
            } 
        }else{
            $exist_evsp = $fevsp->existEventoSpec($eventoSpecifico);
            if(!$exist_evsp){
                if(!$fzona->existZona($eventoSpecifico->getLuogo())) {
                $stored_zona = $fzona->storeZona($eventoSpecifico->getLuogo());
                if($stored_zona) {
                        $stored_evsp = $fevsp->storeEventoSpec($object);
                        $stored_mirror = $fevsp->storeEventoSpec_Mirror($object);                   
                        if($stored_evsp && $stored_mirror) {                   
                            $stored = $fpart->storePartecipazione($object);
                        }
                }
                }else{
                    $stored_evsp = $fevsp->storeEventoSpec($object);
                        $stored_mirror = $fevsp->storeEventoSpec_Mirror($object);                   
                        if($stored_evsp && $stored_mirror) {                   
                            $stored = $fpart->storePartecipazione($object);
                        }
                }
            }else{
                $exist_zona = $fzona->existZona($eventoSpecifico->getLuogo());
                if(!$exist_zona){
                    $stored_zona = $fzona->storeZona($eventoSpecifico->getLuogo());
                    if($stored_zona) {
                        $stored = $fpart->storePartecipazione($object);
                    }
                }else{
                    $stored = $fpart->storePartecipazione($object);
                }
            }    
             

        }

    }
    
    if($object instanceof EUtente_Reg) {
        $utente = new FUtente_Reg();
        $stored = $utente->storeutente($object);
    }
    if($object instanceof EBiglietto) {
        $fevento = USingleton::getInstance('FEvento');
        if($fevento->existEvento($object->getEvento())) {
            $fevsp = USingleton::getInstance('FEventoSpecifico');
            if($fevsp->existEventoSpec($object->getEvento()->getEventoSingolo(0))) {
                $fzona = USingleton::getInstance('FZona');
                if ($fzona->existZona($object->getEvento()->getEventoSingolo(0)->getLuogo())) {
                    $fbigl = USingleton::getInstance('FBiglietto');
                    $stored = $fbigl->storeBiglietto($object);
                }
            }
        }
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



//------------------------------delete methods-----------------------------

    

    
public function delete($object) {

    if($object instanceof EEvento) {
        $evento = USingleton::getInstance('FEvento');
        if($object->getEventoSingolo(0)->getData() == ""){
            $deleted = $evento->deleteEvento($object);
        }else{
            if($object->getEventoSingolo(0)->selezionePartecipazione(0)->getZona()->getNome() != ""){
            $part = USingleton::getInstance('FPartecipazione');
            $deleted = $part->deletePartecipazione($object);
            }else {
                $evento_evsp = USingleton::getInstance('FEventoSpecifico');
                $deleted_evsp = $evento_evsp->delete_EventoSpecifico($object);
                $deleted_evsp_mirror = $evento_evsp->delete_EventoSpecificoMirror($object);
                $deleted = $deleted_evsp && $deleted_evsp_mirror;
            }
        
        }
    }
    if($object instanceof EUtente_Reg) {
        $utente = new FUtente_Reg();
        $deleted = $utente->deleteutente($object);
    }
return $deleted;
}


//------------------------------search methods-----------------------------

public function search($string, $tipo) {
    $fs = USingleton::getInstance('FSearch');
    if($tipo == 'nome') {
        $rows = $fs->searchNome($string);
        for($i=0;$i < count($rows);$i++){
            $code = $rows[$i]['code'];
            $eventi[$i] = $this->istanziaEvento($code);
        }
    }
    if($tipo == 'tipo') {
        $rows = $fs->loadconcspettsport($string);

        for($i=0;$i < count($rows);$i++){
            $code = $rows[$i]['code'];
            $eventi[$i] = $this->istanziaEvento($code);
        }
    }
    return $eventi;
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
      
    private function getLuogoZonaPart($array) { 
        $sql= "SELECT partecipazione.*, zona.capacita "
                ."FROM partecipazione, luogo, zona WHERE code = "
                .$this->connection->quote($array['code'])." AND partecipazione.indirizzo = "
                .$this->connection->quote($array['indirizzo'])." AND data_evento = "
                .$this->connection->quote($array['data_evento'])
                ." AND partecipazione.zona = zona.nome AND partecipazione.indirizzo = zona.indirizzo"
                ." AND partecipazione.indirizzo = luogo.indirizzo";
               
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        
        for($k = 0;$k < count($rows);$k++){
            $result = $this->contaBigliettiDisp($array, $rows[$k]); //è un int di biglietti disponibili

            $bool = $result['disponibili'] > 0;

            $zona = new EZona($rows[$k]['zona'], $rows[$k]['capacita']);
            $part = new EPartecipazione($zona,$rows[$k]['prezzo'], $result['disponibili'], $bool);
            $array_part[$k] = $part;
            list($citta, $struttura) = explode(", ", $array['indirizzo']);
            $luogo = new ELuogo($citta, $struttura);
        }

        $tipo = $array['tipo'];
        $classe = 'E'.$tipo;
        
            if($classe == 'EPartita') {
                $evento= new EPartita($luogo,$array['data_evento'],$array_part,$array['casa'], $array['ospite']);
            }
            if($classe == 'ESpettacolo') {
                $evento = new ESpettacolo($luogo,$array['data_evento'],$array_part,$array['compagnia']);
            }
            if($classe == 'EConcerto') {
                $evento= new EConcerto($luogo,$array['data_evento'],$array_part,$array['artista']);
            }
        
        return $evento;
    }
    
    private function contaBigliettiDisp($array, $rowsk) {
        //deve andare nel database e vedere quanti biglietti sono stati presi e quanti no
        $sql = "SELECT count(*) AS disponibili FROM biglietto WHERE "
                ."code=".$array['code']." AND "
                ."data_evento=".$this->connection->quote($array['data_evento'])." AND "
                ."indirizzo=".$this->connection->quote($array['indirizzo'])." AND "
                ."zona=".$this->connection->quote($rowsk['zona'])." AND mail IS NULL";
                
        $result = $this->connection->query($sql);
        
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        
        return $rows[0];        

    }
    
    
    


}