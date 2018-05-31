<?php


class CHome {
    
    //metodi
    public function getHome() {
        $db = USingleton::getInstance('FDBmanager');
        $db->recuperoDati();

        $home = new VHome();
        $home->setTemplate('Home.tpl');
    }
    
    public function impostaHome() {
        $db = USingleton::getInstance('FDBmanager');
        //$ordine = USingleton::getInstance('EOrdine');
        $sessione = USingleton::getInstance('USession');
        //$eventi_generici deve essere un array tipo $array[k].path_img
        $eventi_generici = $db->load('eventi');

        $json = json_encode($eventi_generici);
        $sessione->imposta_valore('eventi',$json);
        echo $json;
    }
    
    
}

                //$classe = "E$tipo";
        	//$evento = new $classe(

/*$length = count($risultato);
for ($i = 0; $i < $length; $i++) {
            $evento = new EEvento();
            $evento->setId($risultato[$i]['code']);
            $evento->setNome($risultato[$i]['nome']);
        }*/