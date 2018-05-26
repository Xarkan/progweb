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
        