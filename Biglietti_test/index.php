<?php

        require_once 'Autoload.php';
        require_once 'Config.php';

        $controller = USingleton::getInstance('CFrontController');
        $controller->run();
  
        $fdb = new FDBmanager();
        $rows = $fdb->recuperoDati();
               