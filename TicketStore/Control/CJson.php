<?php


class CJson {
    
    public function getJson($p1 , $p2 = '', $p3 = '') {
        //$sessione = USingleton::getInstance('USession');
        $db = USingleton::getInstance('FDBmanager');
        
        if($p1 == 'home') { //questo fa la roba per la home
            $eventi_generici = $db->load($p1);
            $view = USingleton::getInstance('View');
            $view->print_json($eventi_generici);
        }
        else{ //questo fa la roba con i codici del db
            if($p2 == '') { //questo fa la roba del'evento generico-->p1 = cod_e
                $evento = $db->load($p1);
                $view = USingleton::getInstance('View');
                $view->print_json($evento);
            }
            else{
                if($p3 == '') { //questo fa la roba dell'evento specifico
                    $evento_sp = $db->load($p1, $p2);
                    $view = USingleton::getInstance('View');
                    $view->print_json($evento_sp);
                }
                else { //questo fa l'ultimo caso della partecipazione
                    $evento_sp = $db->load($p1, $p2);
                    $part = $evento_sp->selezionePartecipazione($p3);
                    $view = USingleton::getInstance('View');
                    $view->print_json($part);
                }
            }
        }
    }
}
