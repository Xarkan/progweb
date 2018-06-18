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
        header('Location: /TicketStore/home');
    }  
    
    public function set_html_logout() {
        header('Location: /TicketStore/logout');
    }
}
