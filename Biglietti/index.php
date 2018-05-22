<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Biglietti</title>
    </head>
    <body> 
	<?php
        
        require_once 'Autoload.php';
        require_once 'Config.php';

        $controller = USingleton::getInstance('Controller');
        $controller->esegui();

        /*    
            //$chome = new CHome();
            //$chome->impostaHome();
            $evento = new EPartita("0", "Derby", "Milano", "San Siro", "Giuseppe Meazza", "19/4/2018-22:53", "forz inter", "Inter", "Milan");
            $cacquisto = new CAcquistoBiglietto();
            $cacquisto->DataLuogoPrezzo($evento);
            //$cacquisto->mostraZona($evento);
        */    
          $fdbm = new FDBmanager();
                $user = new EUtente_Reg("Pinco","Pallino","pinco@hotmail.it","papero");
 
        //l'utente ha trovato l'evento desiderato e ci ha cliccato  //$cod, $nome, $citta, $struttura, $via, $data, $descrizione, $casa, $ospite
        $sport = new EPartita("0","Derby","Milano", "San Siro", "via abc","30/4/2018-22:53","descrizione0","Napoli","Torino");
        $fdbm->loadDataLuogoPrezzo($sport);
                $lista_zone = $user->mostraZona($sport, $fdbm);
        //l'utente vuole 2 biglietti tribuna
        $ordine = new EOrdine();
                 
 
        $ordine->addZone($lista_zone[0], 2);
                 
        //viene visualizzata l'ordine
                //l'utente imposta nome e cognome ??
                $ordine->setUtente($user);
                $ordine->setId("prova123");
                $data = "21/7/1915";
                $ordine->setData($data);
        $pagato = $user->paga($ordine, $fdbm);
                if($pagato) {
                    $array_biglietti = $ordine->CreaBiglietto($ordine, $fdbm);
                            
                }
        
	?>
    </body>
</html>