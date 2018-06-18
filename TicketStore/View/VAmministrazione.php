<?php

class VAmministrazione {
    
    public function print_json($ultimo_cod) {
        $json = json_encode($ultimo_cod);
        echo $json;
    }
    
    public function set_html() {
        header('Location: /TicketStore/amministratore');
    }
}
