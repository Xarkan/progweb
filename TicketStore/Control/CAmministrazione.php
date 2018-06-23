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
        
        if($this->operazione == 'inserimento') { 
            $evento = $this->creaEvento();  //EEvento
            $result = $db->store($evento);                        
        }
        if($this->operazione == 'cancellazione') {
            $evento = $this->creaEvento();
            $result = $db->delete($evento);            
        }
        $this->alert($result);
        
    }
    
    //crea oggetto evento con i campi che dipendono da $_POST e dalle tipologie
    //di inserimento
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
        if($this->tabella == 'evento' && $this->operazione == 'inserimento') {
            $id = 1 + $fevento->loadultimoevento()[0];
        }
        if($this->tabella == 'evento_spec' || $this->operazione == 'cancellazione') {
            $id = $dati['code'];
            if($this->operazione == 'cancellazione') {
                $feventosp = USingleton::getInstance('FEventoSPecifico');
                $tipo = $feventosp->loadTipo($dati['code'])['tipo'];
                $classe = "E".$tipo;
            }
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
    
    private function alert($bool) {
        if($bool) {
                 echo '<script type="text/javascript">
                            alert("'.$this->operazione.' avvenuto")
                            window.location= "/TicketStore/validazione"
                          </script>'; 
            }else {
                echo '<script type="text/javascript">
                            alert("'.$this->operazione.' NON avvenuto")
                            window.location= "/TicketStore/validazione"
                          </script>';
            }
    }
    
    
    private function assegnaDati() {
        //eventospecifico
        $keys[] = 'code';
        $keys[] = 'nome_evento';
        $keys[] = 'tipo';
        
        $keys[] = 'casa';
        $keys[] = 'ospite';
        $keys[] = 'compagnia';
        $keys[] = 'artista';
        
        $keys[] = 'citta';
        $keys[] = 'struttura';
        
        $keys[] = 'zona';
        $keys[] = 'capacita';
        $keys[] = 'prezzo';
        
        //controlla se $_POST ha determinate chiavi e imposta i valori con la
        //stringa vuota se non 
        for ($i = 0; $i < count($keys); $i++) {
            if(!isset($_POST[$keys[$i]])) {
                $dati[$keys[$i]] = '';
            }else{
                $dati[$keys[$i]] = $_POST[$keys[$i]];
            }
        }
        
        //crea la data col formato giusto
        if(isset($_POST['data_es'])) {
            $dati['data'] = $_POST['data_es']." ".$_POST['ora_es'];            
        }else{
            $dati['data'] = '';
        }
        if(isset($_POST['nome_immagine'])) {
            $dati['immagine'] = '.\\View\\imgs'."\\".$_POST['nome_immagine'];
        }else{
            $dati['immagine'] = '';
        }

        
        return $dati;
    }
}
