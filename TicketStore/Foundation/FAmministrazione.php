<?php

class FAmministrazione extends FDBmanager {
    
//-------------------------exist methods------------------------------------    
    



public function exist_es($code,$data){
    $evento_spec = new FEventospecifico();
    $exist = $evento_spec->existeventospec($code, $data);
    return $exist;
    
}


//----------------------------store methods---------------------------------


public function store_bigl($num,$nome_evento,$data,$zona,$code,$indirizzo) {
    $bigl = new FBiglietto();
    $stored = $bigl->generabiglietti($num, $nome_evento, $data, $zona, $code, $indirizzo);
   
    return $stored;
}



public function store_es($codes,$data,$luogo,$tipo,$casa,$ospite,$compagnia,$artista) {
    $evento_spec = new FEventoSpecifico();
    
    $exist_luogo = $this->existluogo($luogo);
    if(!$exist_luogo){
       $stored_luogo = $this->storeluogo($luogo);
        if($stored_luogo){
            $stored = $evento_spec->storeeventospec($codes, $data, $luogo, $tipo, $casa, $ospite, $compagnia, $artista);
            $stored_mirror = $evento_spec->storeeventospecmirror($codes, $data, $luogo, $tipo, $casa, $ospite, $compagnia, $artista);
    } 
    }
    else{
        $stored = $evento_spec->storeeventospec($codes, $data, $luogo, $tipo, $casa, $ospite, $compagnia, $artista);
        $stored_mirror = $evento_spec->storeeventospecmirror($codes, $data, $luogo, $tipo, $casa, $ospite, $compagnia, $artista);
    }
    return $stored && $stored_mirror;
    
}




//---------------------------load methods----------------------------------

public function loadultimocodice() {
    $evento = new FEvento();
    $codice = $evento->loadultimoevento();
    return $codice;
}


//-----------------------------update methods-------------------------------

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

public function delete_es($codes,$data) {
    $sql = "DELETE FROM evento_spec WHERE code = ".$this->connection->quote($codes)
          ."AND data_evento = ".$this->connection->quote($data);
    $result = $this->connection->exec($sql);
    
    return $result > 0;
    
}

public function delete_es_mirror($codes,$data) {
    $sql = "DELETE FROM evento_spec_mirror WHERE code = ".$this->connection->quote($codes)
          ."AND data_evento = ".$this->connection->quote($data);
    $result = $this->connection->exec($sql);
    
    return $result > 0;
    
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

}
