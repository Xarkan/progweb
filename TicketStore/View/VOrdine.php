<?php

class VOrdine {
    
    public function print_json($ordine) {
        $json = json_encode($ordine);
        echo $json;
    }
}
