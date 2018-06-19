<?php

class CDebug {
    
    public function getDebug() {
        
        $data = new DateTime(null, new DateTimeZone('Europe/Rome'));
        $result = date_format($data, 'd-m-Y H:i:sP');
        
        echo "<pre>";
        print_r($result);
        echo "</pre>";
    }
}
