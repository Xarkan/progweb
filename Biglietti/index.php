<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Biglietti</title>
    </head>
    <body> 
	<?php
		include 'Autoload.php';

		$user = new EUtente_Reg("ciccio","pasticcio","cp@boh.org","marooon");
		$fdbm = new FDBmanager();
                /*$sql = "DELETE FROM biglietti WHERE utente = 'ciccio pasticcio';\n INSERT INTO biglietti VALUES('0', 'A1', NULL, 'tribuna', 24);";
                $reset = $fdbm->getConnection();
                $reset->exec($sql);*/
		//l'utente ha trovato l'evento desiderato e ci ha cliccato
		$sport = new EPartita("0","Derby","Milano", "San Siro", "boh","21/7/1983","abc","def","Napoli","Torino");

		$lista_zone = $user->mostraZona($sport, $fdbm);
		//l'utente vuole 2 biglietti tribuna
		$ordine = new EOrdine();
                

		$ordine->addZone($lista_zone[1], 2);
                
		//viene visualizzata l'ordine
                //l'utente imposta nome e cognome ??
                $ordine->setUtente($user);
                $ordine->setId("prova123");
                $data = "21/7/15";
                $ordine->setData($data);
		$user->paga($ordine, $fdbm);




	?>
    </body>
</html>