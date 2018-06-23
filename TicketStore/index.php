<?php   

        error_reporting(E_WARNING);
     
        require_once 'Autoload.php';
        require_once 'Config.php';
        $controller = USingleton::getInstance('CFrontController');
        $controller->run();
       

        

               