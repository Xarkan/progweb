<?php


class VRicerca {
    public function print_json($eventi) {
        $json = json_encode($eventi);
        echo $json;
    }
    
    public function set_html() {

        header('Location: /TicketStore/ricercautente');
    }
}
