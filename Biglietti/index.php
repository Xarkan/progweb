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
            $evento = new EPartita("0", "Derby", "Milano", "San Siro", "Giuseppe Meazza", "27/03/1994", "forz inter", "Inter", "Milan");
            $cacquisto = new CAcquistoBiglietto();
            $cacquisto->DataLuogoPrezzo($evento);
            
            
	?>
    </body>
</html>