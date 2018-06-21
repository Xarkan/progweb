<?php   
        /*if(isset($_SERVER)) {
            if($_SERVER['REQUEST_SCHEME'] == "http") {
                $_SERVER['REQUEST_SCHEME'] = "https";
            }
        }*/
        /*echo '<pre>';
        print_r($_SERVER);
        echo'</pre>';*/
        //$i = 0;
        error_reporting(E_WARNING);
     
        require_once 'Autoload.php';
        require_once 'Config.php';
        $controller = USingleton::getInstance('CFrontController');
        $controller->run();
       

        

               