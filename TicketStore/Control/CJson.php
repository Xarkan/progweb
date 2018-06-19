<?php


class CJson {
    
    public function getJson($p1 , $p2 = '', $p3 = '') {
        $sessione = USingleton::getInstance('USession');
        $db = USingleton::getInstance('FDBmanager');
        $view = USingleton::getInstance('View');
        
        if($p1 == 'logged') {
            $validazione = USingleton::getInstance('CValidazione');
            $logged = $validazione->isLogged();
            $view->print_json($logged);
        }else {
            if($p1 == 'ordine') {
                $dettagli_ordine['ordine'] = $sessione->recupera_valore('ordine');
                $dettagli_ordine['img'] = $sessione->recupera_valore('img');
                $dettagli_ordine['posti'] = $sessione->recupera_valore('posti');            
                $view->print_json($dettagli_ordine);        
            }else{
     
                if($p1 == 'home') { //questo fa la roba per la home
                    $eventi_generici = $db->load($p1);
                    $view->print_json($eventi_generici);
                }else {
                    if($p1 == 'biglietto') {
                        $biglietti = $sessione->recupera_valore('biglietti');
                        $view->print_json($biglietti);
                    }else{ //questo fa la roba con i codici del db
                        if($p2 == '') { //questo fa la roba del'evento generico-->p1 = cod_e
                            $evento = $db->load($p1);
                            $view->print_json($evento);
                        }else{
                            if($p3 == '') { //questo fa la roba dell'evento specifico
                                $evento_sp = $db->load($p1, $p2);
                                $view->print_json($evento_sp);
                            }else{ //questo fa l'ultimo caso della partecipazione
                                $evento_sp = $db->load($p1, $p2);
                                $part = $evento_sp->selezionePartecipazione($p3);
                                $view->print_json($part);
                            }
                        }
                    }
                }
            }  
        }
    }
}
