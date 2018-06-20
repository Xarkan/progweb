<?php   
        /*if(isset($_SERVER)) {
            if($_SERVER['REQUEST_SCHEME'] == "http") {
                $_SERVER['REQUEST_SCHEME'] = "https";
            }
        }*/
        error_reporting(E_WARNING);
        setcookie("cookie_test", "cookie_value", time()+3600);
        function php_cookie_enable()
        {
            if ($_COOKIE["cookie_test"] == "cookie_value")
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        
        if (php_cookie_enable() == false /*|| !isset ($_COOKIE['js'])*/ ){
                if (php_cookie_enable() == false){
                    echo "I cookie sono disabilitati. Per Un corretto uso dell applicazione, Abilitare i cookie!";
                    echo "<html><br><a href='https://www.aranzulla.it/come-abilitare-i-cookie-21458.html'>Come abilitare i cookie<a></html>";
                }
                 /*if (!isset ($_COOKIE['Javascript'])) {
                    echo "Javascript disabilitato. Per Un corretto uso dell applicazione, Abilitare Javascript!";
                    echo "<html><br><a href='https://www.aranzulla.it/come-abilitare-javascript-23691.html'>Come abilitare Javascript<a></html>";
                }*/
        }
       
        else{
            require_once 'Autoload.php';
            require_once 'Config.php';

            $controller = USingleton::getInstance('CFrontController');
            $controller->run();
        }

        

               