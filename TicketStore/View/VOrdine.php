<?php

class VOrdine {
    
    public function print_json($dettagli_ordine) {
        $json = json_encode($dettagli_ordine);
        echo $json;
    }
    
    public function set_html() {
        header('Location: /TicketStore/carrello');
    }
}
