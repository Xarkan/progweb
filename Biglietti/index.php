<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Biglietti</title>
    </head>
    <body> 
        <?php 
        
        include 'Autoload.php';
        
        $posto = new ELuogo("Milano", "San Siro", "boh");
        $data = date("r");
        $sport = new EPartita("0","Derby",$posto,$data,"abc","def","Napoli","Torino");
        $teatro = new ESpettacolo("1","DT in concert", $posto, $data, "abc","def", "Dream Theater");
        
        echo $sport->getData();
        echo " ".$teatro->getNome();
        
        //$dbm = new FDBmanager();
        //echo $dbm->getError();
        /*
        $e1 = new EBiglietti_Zona("Live", "Platea", 13);      //test add/remove
        $e2 = new EBiglietti_Zona("Partita", "Prato", 50);
        $e3 = new EBiglietti_Zona("Opera","Galleria", 15);
        
        $array = array($e1,$e2,$e2,$e3);
        $ord = new EOrdine(1, "Pippo", $array, $data, false);
        $utente = new EUtente_Reg("federico", "raparelli", "jebfbihb", "abc");
        $utente->paga($ord);
        echo var_dump($ord->getPagato());
        echo $ord->calcolaPrezzo();*/
        
        //$ord->removeBigl($e2);
        //var_dump($ord->getLista_bigl()); 
        
        $test = new FEvento();
        $test->exist($sport);
        
        ?>
        <h1>PROVA</h1>
    </body>
</html>
