<?php   
        /*if(isset($_SERVER)) {
            if($_SERVER['REQUEST_SCHEME'] == "http") {
                $_SERVER['REQUEST_SCHEME'] = "https";
            }
        }*/

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
        
        if (php_cookie_enable() == false){
                echo "Attenzione hai i cookie disabilitati!";
        }
        else{
            require_once 'Autoload.php';
            require_once 'Config.php';

            $controller = USingleton::getInstance('CFrontController');
            $controller->run();
        }

        

               