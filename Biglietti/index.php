<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Biglietti</title>
    </head>
    <body> 
	<?php
		include 'Autoload.php';
 
		$fdbm = new FDBmanager();
                $user = new EUtente_Reg("Pinco","Pallino","pinco@hotmail.it","papero");
                //$fdbm->store($user);
                /*$sql1 = "DELETE FROM biglietti WHERE utente = 'ciccio pasticcio';\n INSERT INTO biglietti VALUES('0', 'A1', NULL, 'tribuna', 24);";
                $sql2 = "DELETE FROM ordine WHERE id = 'prova123'";
                $sql3 = "DELETE FROM ordine_biglietto WHERE id_ord = 'prova123'";
                $reset = $fdbm->getConnection();
                $reset->exec($sql1);
                $reset->exec($sql2);
                $reset->exec($sql3);*/
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
                $data = "21/7/1915";
                $ordine->setData($data);
		$pagato = $user->paga($ordine, $fdbm);
                if($pagato) {
                    $array_biglietti = $fdbm->CreaBiglietto($ordine);
                }



	?>
    </body>
</html>