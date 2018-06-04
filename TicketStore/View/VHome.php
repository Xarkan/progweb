<?php

class VHome {
    
    public function print_json($eventi_generici) {
        $json = json_encode($eventi_generici);
        echo $json;
    }
}
