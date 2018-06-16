<?php

class View {
    
    public function print_json($object) {
        $json = json_encode($object);
        echo $json;
    }
    
    public function operazioneInvalida() {
        header('Location: /TicketStore/View/html/not-found.html');
    }
    public function avviaHome() {
        //$sessione = USingleton::getInstance('USession');
        //$sessione->distruggiSessioneCookie();
        header('Location: /TicketStore/home.html');
    }  
}
