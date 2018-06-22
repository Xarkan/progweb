<?php

class CAmministrazione2 {
    
    private $operazione;
    private $tabella;
    private $dati = [];
    private $classe;
    
    public function __construct() {
        $this->operazione = $_POST['Operazione'];
        $this->tabella = $_POST['Tabella'];
        
        $this->dati = $this->assegnaDati();
        
        $this->classe = "E".$dati['tipo'];
    }
    
    public function postAmministrazione2() {       
                
        if($this->operazione == 'inserimento' && $this->tabella == 'evento') { //evento con nuovi dati non presenti nel db
            $evento = $this->creaEvento();  //EEvento
            $db->store($evento);
        }
    }
    
    private function creaEvento() {
        
        $dati = $this->dati;
            $luogo = new ELuogo($dati['citta'], $dati['struttura']);
            $zona = new EZona($dati['zona'], $dati['capacita']);
            $partecipazioni = new EPartecipazione($zona, $dati['prezzo']);
            
            $eventoSpecifico[] = new $this->classe($luogo,$dati['data'],$partecipazioni);
            $evento = new EEvento($id, $dati['immagine'], $dati['nome'],$eventoSpecifico);
        
            return $evento;
    }
    
    
    public function assegnaDati() {
        //eventospecifico
        $dati['tipo'] = $_POST['tipo'];
        $dati['data'] = $_POST['data_es']." ".$_POST['ora_es'];
        $dati['struttura'] = $_POST['struttura'];
        $dati['citta'] = $_POST['citta'];
        $dati['codes'] = $_POST['codes'];
        $dati['casa'] = $_POST['casa'];
        $dati['ospite'] = $_POST['ospite'];
        $dati['compagnia'] = $_POST['compagnia'];
        $dati['artista'] = $_POST['artista'];
        //partecipazione
        $dati['codep'] = $_POST['codep'];
        $dati['zona'] = $_POST['zona'];
        $dati['indirizzop'] = $_POST['indirizzop'];
        $dati['prezzo'] = $_POST['prezzo'];
        //zona
        $dati['indirizzoz'] = $_POST['indirizzoz'];
        $dati['capacita'] = $_POST['capacita'];
        //biglietto
        $dati['numero_bigl'] = $_POST['numero_bigl'];
        $dati['nome_evento'] = $_POST['nome_evento'];
        
        
        
        $dati['num_luogo'] = $_POST['num_luogo']; //è obbligatorio almeno 1 nella selezione

        for ($i = 0; $i < $dati['num_luogo']; $i++) {
            $array[$i] = $_POST['citta'.$i];
            $dati['citta'] = $array[$i];
        }

        
        return $dati;
    }
}
