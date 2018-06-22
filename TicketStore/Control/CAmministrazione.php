<?php

class CAmministrazione {
    
    private $operazione;
    private $tabella;
    private $dati = [];
    private $classe;
    
    public function __construct() {
        $this->operazione = $_POST['Operazione'];
        $this->tabella = $_POST['Tabella'];
        
        $this->dati = $this->assegnaDati();
        $dati = $this->dati;
        $this->classe = "E".$dati['tipo'];
    }
    
    public function postAmministrazione() {
        $db = USingleton::getInstance('FDBmanager');  
        
        if($this->operazione == 'inserimento') { //evento con nuovi dati non presenti nel db
            $evento = $this->creaEvento();  //EEvento

            $stored = $db->store($evento);
            var_dump($stored);
            
            if($stored) {
                 echo '<script type="text/javascript">
                            alert("inserimento avvenuto")
                            window.location= "/TicketStore/validazione"
                          </script>'; 
            }else {
                echo '<script type="text/javascript">
                            alert("inserimento NON avvenuto")
                            window.location= "/TicketStore/validazione"
                          </script>';
            }
        }
        
        
    }
    
    private function creaEvento() {
        $fevento = USingleton::getInstance('FEvento');
        $dati = $this->dati;
        $classe = $this->classe;
        
        if($this->tabella == 'partecipazione') {
            $feventosp = USingleton::getInstance('FEventoSPecifico');
            $tipo = $feventosp->loadTipo($dati['code'])['tipo'];
            $classe = "E".$tipo;
            $id = $dati['code'];
        }
            if($this->tabella == 'evento') {
                $id = 1 + $fevento->loadultimoevento()[0];
            }
            if($this->tabella == 'evento_spec') {
                $id = $dati['code'];
        }

        
            
            $zona = [new EZona($dati['zona'], $dati['capacita'])];
            $luogo = new ELuogo($dati['citta'], $dati['struttura'],$zona);
            $partecipazioni = [new EPartecipazione($zona[0], $dati['prezzo'])];
            
            if($classe == 'EPartita') {
                $eventoSpecifico = [new EPartita($luogo,$dati['data'],$partecipazioni,$dati['casa'], $dati['ospite'])];
            }
            if($classe == 'ESpettacolo') {
                $eventoSpecifico = [new ESpettacolo($luogo,$dati['data'],$partecipazioni,$dati['compagnia'])];
            }
            if($classe == 'EConcerto') {
                $eventoSpecifico = [new EConcerto($luogo,$dati['data'],$partecipazioni,$dati['artista'])];
            }
            
            $evento = new EEvento($id, $dati['immagine'], $dati['nome_evento'],$eventoSpecifico);
        
            return $evento;            
        
    }
    
    
    public function assegnaDati() {
        //eventospecifico
        $dati['code'] = $_POST['code'];
        $dati['nome_evento'] = $_POST['nome_evento'];
        $dati['immagine'] = $_POST['nome_immagine'];
        $dati['data'] = $_POST['data_es']." ".$_POST['ora_es'];
        $dati['tipo'] = $_POST['tipo'];
        
        $dati['casa'] = $_POST['casa'];
        $dati['ospite'] = $_POST['ospite'];
        $dati['compagnia'] = $_POST['compagnia'];
        $dati['artista'] = $_POST['artista'];
        
        $dati['citta'] = $_POST['citta'];
        $dati['struttura'] = $_POST['struttura'];

        $dati['zona'] = $_POST['zona'];
        $dati['capacita'] = $_POST['capacita'];
        $dati['prezzo'] = $_POST['prezzo'];                
        
        return $dati;
    }
}
