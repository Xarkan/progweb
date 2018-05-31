<?php
        
        require_once 'Autoload.php';
        require_once 'Config.php';

        $controller = USingleton::getInstance('Controller');
        $controller->esegui();
  
        $fdb = new FDBmanager();
        $rows = $fdb->recuperoDati();
        