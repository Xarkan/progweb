<?php

class FEventospecifico extends FDBmanager {
    
    public function __construct() {
        parent::__construct();
        
    }


    public function loadDataLuogoPrezzo(EEvento $evento){
        $sql = "SELECT  *"
          ." FROM evento_spec AS es "
          ." WHERE es.cod_evento = ". $this->connection->quote($evento->getCodev());
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll();
    
        return $rows;
    }
    
    public function loadEventoSp($cod_e,$data) {
        $sql = "SELECT * FROM evento_spec WHERE code=".$this->connection->quote($cod_e).
                " AND data_evento=".$this->connection->quote($data);
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
    
    public function loadEventiSp($cod_e) {
        $sql = "SELECT * FROM evento_spec WHERE code=".$this->connection->quote($cod_e);
                
        $result = $this->connection->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
    public function storeeventospec($codes,$data,$luogo,$tipo,$casa,$ospite,$compagnia,$artista) {
    
    $cod = $this->connection->quote($codes);
    $dat = $this->connection->quote($data);
    $luo = $this->connection->quote($luogo);
    $tip = $this->connection->quote($tipo);
    $cas = $this->connection->quote($casa);
    $osp = $this->connection->quote($ospite);
    $com = $this->connection->quote($compagnia);
    $art = $this->connection->quote($artista);
    /*echo '<pre>';
    echo $cod;
    echo $dat;
    echo $luo;
    echo $tip;
    echo $cas;
    echo $osp;
    echo $com;
    echo $art;
    echo '</pre>';*/
    
    $statement = $this->connection->prepare("INSERT INTO evento_spec (code,data_evento,indirizzo,tipo,casa,ospite,compagnia,artista) VALUES(:code,:data_evento,:indirizzo,:tipo,:casa,:ospite,:compagnia,:artista)");
    $statement->bindParam(':code', $cod, PDO::PARAM_STR, 255);
    $statement->bindParam(':data_evento', $dat);
    $statement->bindParam(':indirizzo', $luo, PDO::PARAM_STR, 255);
    $statement->bindParam(':tipo', $tip, PDO::PARAM_STR, 255);
    $statement->bindParam(':casa', $cas, PDO::PARAM_STR, 255);
    $statement->bindParam(':ospite', $osp, PDO::PARAM_STR, 255);
    $statement->bindParam(':compagnia', $com, PDO::PARAM_STR, 255);
    $statement->bindParam(':artista', $art, PDO::PARAM_STR, 255);
    
    $statement->execute();
    //var_dump($statement->execute());
    /*$sql = "INSERT INTO evento_spec "
          .'VALUES ('.$this->connection->quote($codes).','
          .$this->connection->quote($data).","
          .$this->connection->quote($luogo).","
          .$this->connection->quote($tipo).","
          .$this->connection->quote($casa).","
          .$this->connection->quote($ospite).","
          .$this->connection->quote($compagnia).","
          .$this->connection->quote($artista)."".")";
    $result = $this->connection->exec($sql);
    //echo $sql;
    //var_dump($result);
    return $result;
    */
    }
    public function deleteeventospec($codes,$data) {

        $sql = "DELETE FROM evento_spec WHERE code = ".$codes." AND data_evento = ".$data; 
        $result = $this->connection->exec($sql);
        return $result;
    }
}