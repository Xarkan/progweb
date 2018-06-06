<?php

class View {
    
    public function operazioneInvalida() {
        header('Location: /TicketStore/View/html/not-found.html');
    }
    public function avviaHome() {
        header('Location: /TicketStore/home.html');
    }  
}
