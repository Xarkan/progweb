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

		//l'utente ha trovato l'evento desiderato e ci ha cliccato
		$sport = new EPartita("0","Derby","Milano", "San Siro", "boh","21/7/1983","abc","def","Napoli","Torino");

		$lista_zone = $user->mostraZona($sport, $fdbm);

		//l'utente vuole 2 biglietti tribuna
		$ordine = new EOrdine();
                

		$ordine->addZone($lista_zone[0], 2);

		//viene visualizzata la schermata di pagamento
		$user->paga($ordine, $fdbm);




	?>
    </body>
</html>