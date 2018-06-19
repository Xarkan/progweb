<?php


class CJson {
    
    public function getJson($p1 , $data = '', $index_partecipazione = '') {
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
                        if($data == '') { //questo fa la roba del'evento generico-->p1 = cod_e
                            $evento = $db->load($p1);
                            $view->print_json($evento);
                        }else{
                            $string = explode("_", $data);
                            $data = $string[0]." ".$string[1];
                            if($index_partecipazione == '') { //questo fa la roba dell'evento specifico
                                $evento_sp = $db->load($p1, $data);
                                $view->print_json($evento_sp);
                            }else{ //questo fa l'ultimo caso della partecipazione
                                $evento_sp = $db->load($p1, $data);
                                $part = $evento_sp->selezionePartecipazione($index_partecipazione);
                                $view->print_json($part);
                            }
                        }
                    }
                }
            }  
        }
    }
}
