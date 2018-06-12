<?php


class CAmministrazione {
    
    public function postAmministrazione() {
        $db = USingleton::getInstance('FDBmanager');
        
        $operazione = $_POST['Operazione'];
        $tabella = $_POST['Tabella'];
        
        //----------------------------gestione evento------------------------------------------------------
        $id = $_POST['codice_evento'];
        $nome_evento = $_POST['nome_evento'];
        $img = $_POST['path_immagine'].$_POST['nome_immagine'];
        
        if($id != "" && $nome_evento != "" && $img != ""){
            $eventi = "";
            $evento = new EEvento($id, $img, $nome_evento, $eventi);
            if($operazione == 'inserimento'){
                $db->store($evento);
            }
            /*da vedere bene l'operazione di modifica
            if(($operazione == 'modifica')){
                $db->update($evento);
            }*/
            if($operazione == 'cancellazione'){
                $db->delete($evento);
            }
        }
        else{
            //messaggi di alert che comunicano all'amministratore che non ha inserito alcuni campi
        }
        
        //----------------------------gestione utente_r------------------------------------------------------
        $mail = $_POST['mail'];
        if($mail != ""){
            $utente = new EUtente_Reg("", "" , $mail, "");
            if($operazione == 'cancellazione'){
                echo '<pre>';
                print_r($_POST);
                echo '</pre>';
                $deleted = $db->delete($utente);
                //var_dump($db);
            }
            if($deleted){
                echo '<pre>';
                print_r($_POST);
                echo '</pre>';
            }
        }
        else{
            //messaggi di alert che comunicano all'amministratore che non ha inserito alcuni campi
        }
        
        //----------------------------gestione evento_specifico------------------------------------------------------
        $tipo = $_POST['tipo'];
        $data = $_POST['data_es'];
        $luogo = $_POST['indirizzo'];
        $codes = $_POST['codes'];
        $casa = $_POST['casa'];
        $ospite = $_POST['ospite'];
        $compagnia = $_POST['compagnia'];
        $artista = $_POST['artista'];
        if($tipo != "" && $data != "" && $luogo != "" && $codes != ""){
            if($operazione == 'inserimento'){
               $stored = $db->store_es($codes,$data,$luogo,$tipo,$casa,$ospite,$compagnia,$artista);
               echo '<pre>';
               print_r($_POST);
               echo '</pre>';
               //var_dump($stored);
            }
            /*da vedere bene l'operazione di modifica
            if(($operazione == 'modifica')){
                
            }*/
            if($operazione == 'cancellazione'){
                $db->delete_es($codes,$data);
            }
           
        }
        else{
            //messaggi di alert che comunicano all'amministratore che non ha inserito alcuni campi
        }
        
        //----------------------------gestione partecipazioni------------------------------------------------------
        $codep = $_POST['codep'];
        $datap = $_POST['datap'];
        $zona = $_POST['zona'];
        $indirizzop = $_POST['indirizzop'];
        $prezzo = $_POST['prezzo'];
        if($codep != "" && $datap != "" && $zona != "" && $indirizzop != "" && $prezzo != ""){
            if($operazione == 'inserimento'){
                $db->store_partecipazione($codep,$datap,$zona,$indirizzop,$prezzo);
            }
            /*da vedere bene l'operazione di modifica
            if(($operazione == 'modifica')){
                
            }*/
            if($operazione == 'cancellazione'){
                $db->delete_partecipazione($codep,$datap,$zona,$indirizzop,$prezzo);
            }
            else{
            //messaggi di alert che comunicano all'amministratore che non ha inserito alcuni campi
            }
        }
        
        
    }
}
