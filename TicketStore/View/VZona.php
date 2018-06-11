<?php

class VZona {
    
    public function set_html($id_e, $id_esp) {
        header('Location: /TicketStore/zone/'.$id_e.'/'.$id_esp);
    }
}
