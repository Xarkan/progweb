<?php
 class EUtente {
       
    //metodi
    public function paga(EOrdine $ordine, FDBmanager $dbm){
        if($ordine->getPagato() == false)
        {
            $prezzo = $ordine->calcolaPrezzo($ordine->getLista_bigl());
            //contatta paypal
            try {
                $dbm->getConnection()->beginTransaction();
                $list_zone = $ordine->getLista_bigl();
                $disp = $dbm->exist($list_zone[0]);
                if($disp) {
                $ordine->setPagato(true);
                }
                $conferma = $dbm->confermaordine($ordine);
                $dbm->getConnection()->commit();
                return $conferma;
            }
            catch (Exception $e) {
                $dbm->getConnection()->rollBack();
                echo $e->getMessage();
            }
        }
    }


}
