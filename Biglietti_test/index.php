<?php   
        /*if(isset($_SERVER)) {
            if($_SERVER['REQUEST_SCHEME'] == "http") {
                $_SERVER['REQUEST_SCHEME'] = "https";
            }
        }*/

        require_once 'Autoload.php';
        require_once 'Config.php';
              
        $controller = USingleton::getInstance('CFrontController');
        $controller->run();

               