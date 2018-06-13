<?php

class VAmministrazione {
    
    public function print_json($ultimo_cod) {
        $json = json_encode($ultimo_cod);
        echo $json;
    }
}
