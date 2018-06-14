<?php


class CAmministrazione {
    
    public function postAmministrazione() {
        $db = USingleton::getInstance('FDBmanager');
        
        $operazione = $_POST['Operazione'];
        $tabella = $_POST['Tabella'];
        
        //----------------------------gestione evento------------------------------------------------------
        if($tabella == 'evento') {
        $id = $_POST['codice_evento'];
        $nome_evento = $_POST['nome_evento'];
        $img = $_POST['path_immagine'].$_POST['nome_immagine'];
        
        if($id != "" && $nome_evento != "" && $img != ""){
            $eventi = "";
            $evento = new EEvento($id, $img, $nome_evento, $eventi);
            if($operazione == 'inserimento'){
                $stored = $db->store($evento);
            }
            if($stored){
                echo '<script type="text/javascript">
                        alert("inserimento avvenuto")
                        window.location= "/TicketStore/amministratore"
                      </script>'; 
            }
            /*da vedere bene l'operazione di modifica
            if(($operazione == 'modifica')){
                $db->update($evento);
            }*/
            if($operazione == 'cancellazione'){
                $deleted = $db->delete($evento);
            }
             if($deleted){
                echo '<script type="text/javascript">
                        alert("la cancellazione è avvenuta correttamente")
                        window.location= "/TicketStore/amministratore"
                      </script>'; 
            }
        }
        else{
            //messaggi di alert che comunicano all'amministratore che non ha inserito alcuni campi
        }
        }
        
        //----------------------------gestione utente_r------------------------------------------------------
        if($tabella == 'utente_r') {
        $mail = $_POST['mail'];
        if($mail != ""){
            $utente = new EUtente_Reg("", "", $mail, "");
            if($operazione == 'cancellazione'){
                
                $deleted = $db->delete($utente);
                //var_dump($db);
            }
            if($deleted){
                echo '<script type="text/javascript">
                        alert("la cancellazione è avvenuta correttamente")
                        window.location= "/TicketStore/amministratore"
                      </script>'; 
            }

        }
        else{
            //messaggi di alert che comunicano all'amministratore che non ha inserito alcuni campi
        }
        }
        //----------------------------gestione evento_specifico------------------------------------------------------
        if( $tabella == 'evento_spec') {
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
         
            }
            if($stored){
                echo '<script type="text/javascript">
                        alert("inserimento avvenuto")
                        window.location= "/TicketStore/amministratore"
                      </script>'; 
            }
            /*da vedere bene l'operazione di modifica
            if(($operazione == 'modifica')){
                
            }*/
            if($operazione == 'cancellazione'){
                $deleted = $db->delete_es($codes,$data);
            }
             if($deleted){
                echo '<script type="text/javascript">
                        alert("la cancellazione è avvenuta correttamente")
                        window.location= "/TicketStore/amministratore"
                      </script>'; 
            }
           
        }
        else{
            //messaggi di alert che comunicano all'amministratore che non ha inserito alcuni campi
        }
        }
        //----------------------------gestione partecipazioni------------------------------------------------------
        if($tabella == 'partecipazione') {
        $codep = $_POST['codep'];
        $datap = $_POST['datap'];
        $zona = $_POST['zona'];
        $indirizzop = $_POST['indirizzop'];
        $prezzo = $_POST['prezzo'];
        if($codep != "" && $datap != "" && $zona != "" && $indirizzop != "" && $prezzo != ""){
            if($operazione == 'inserimento'){
                $stored = $db->store_partecipazione($codep,$datap,$zona,$indirizzop,$prezzo);
            }
            if($stored){
                echo '<script type="text/javascript">
                        alert("inserimento avvenuto")
                        window.location= "/TicketStore/amministratore"
                      </script>'; 
            }
            /*da vedere bene l'operazione di modifica
            if(($operazione == 'modifica')){
                
            }*/
            if($operazione == 'cancellazione'){
                $deleted = $db->delete_partecipazione($codep,$datap,$zona,$indirizzop,$prezzo);
            }
             if($deleted){
                echo '<script type="text/javascript">
                        alert("la cancellazione è avvenuta correttamente")
                        window.location= "/TicketStore/amministratore"
                      </script>'; 
            }
            else{
            //messaggi di alert che comunicano all'amministratore che non ha inserito alcuni campi
            }
        }
        }
        
    }
    
    public function getAmministrazione() {
        $db = USingleton::getInstance('FDBmanager');
        $ultimo_cod = $db->loadultimocodice();
        $vamministrazione = new VAmministrazione();
        $vamministrazione->print_json($ultimo_cod);
    }
}
