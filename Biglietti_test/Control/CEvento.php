<?php

class CEvento {
    
    public function getEvento($id) {
        $dlp = new VDataLuogoPrezzo();
        $dlp->setDataIntoTemplate('id', $id);
        $dlp->setTemplate('DataLuogoPrezzo.tpl');
    }
}
