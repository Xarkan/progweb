<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Biglietti</title>
    </head>
    <body> 
	<?php
            include 'Autoload.php';
            include 'Config.php';
            //$chome = new CHome();
            //$chome->impostaHome();
            $evento = new EPartita("0", "Derby", "Milano", "San Siro", "Giuseppe Meazza", "19/4/2018-22:53", "forz inter", "Inter", "Milan");
            $cacquisto = new CAcquistoBiglietto();
            $cacquisto->DataLuogoPrezzo($evento);
            //$cacquisto->mostraZona($evento);
            
            
	?>
    </body>
</html>