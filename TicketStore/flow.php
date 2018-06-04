<?php

        
//Options -Indexes
//RewriteEngine on

//RewriteCond %{REQUEST_FILENAME} !-f
//RewriteCond %{REQUEST_FILENAME} !-d
//RewriteCond %{REQUEST_FILENAME} !.*\.{png|jpg|css|js|html}$
//RewriteCond %{REQUEST_FILENAME} !.*evento/([0-9])
//RewriteRule ^(.*)$ index.php [NC,L]

//RewriteRule ^evento/([0-9]+) dettagli.html?id=$1 [NC,L]

	include 'Autoload.php';

	$zona1 = new EZona("Prato",20,24.50); //nome, capacità, prezzo, disponibilità, array?
	$zona2 = new EZona("Spalti",10,19.75);
	$zone = array($zona1,$zona2);
	$luogo1 = new ELuogo("Roma","via1","Olimpico",$zone); //citta,via,struttura,zone
	$luogo2 = new ELuogo("Milano","via2","San Siro");
	$luogo3 = new ELuogo("Bologna","via3","Piazza Maggiore");
	$concerto1 = new EConcerto("data1",$luogo1,"Deep Purple");
	$concerto2 = new EConcerto("data2",$luogo2,"Deep Purple");
	$concerto3 = new EConcerto("data3",$luogo3,"Deep Purple");

	$eventi = array($concerto1,$concerto2,$concerto3);
	$tour = new EEvento("codice","DPLive",$eventi);

	//viene creato all'avvio della Home tramite Control
	$ordine = USingleton::getInstance('EOrdine');

	//getEventi() restitutisce array di EEvSpec e scrive il nome in EOrdine
	$date = $tour->getEventi(); 
        
        //getEventoSingolo($index) restituisce l'evento (selezionato dall'utente)
        $eventoSpecifico = $date->getEventoSingolo(1); //indice nell'evento

	//getPartecipazioni() restituisce un array di EPartecipazione
	$partecipazioni = $eventoSpecifico->getPartecipazioni();
        
        //controllo su disponibilità (penso fatto da Control)
        
        //selezionePartecipazione($index) restituisce la partecipazione selezionata
        $partSingola = $partecipazioni->selezionePartecipazione(2);
        
        //addElementi() aggiunge all'ordine il numero di biglietti desiderato
        $ordine->addElementi($partSingola, 3);
        
        //L'utente si è sbagliato e vuole toglierne uno..
        $ordine->rimuoviElemento();
        //ora ci sono solo 2 elementi
        
        //L'utente deve essere registrato per poter pagare
        $utente = new EUtente_Reg("pippo","baudo","pippo.baudo@gmail.com","password");
        
        //fa lo store dell'ordine nel db e imposta pagato = true
	$utente->paga();
        
        //creaBiglietti() genera i biglietti e li restituisce
        $ordine->creaBiglietti();
        
        //