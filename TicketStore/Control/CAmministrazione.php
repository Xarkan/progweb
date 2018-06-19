<?php


class CAmministrazione {
    
    public function postAmministrazione() {
        $db = USingleton::getInstance('FDBmanager');
        
        $operazione = $_POST['Operazione'];
        $tabella = $_POST['Tabella'];
        
        //----------------------------gestione evento------------------------------------------------------
        
        
        if($tabella == 'evento' && $operazione == 'inserimento') {
        //$id = $_POST['codice_evento'];
        $ultimo_cod = $db->loadultimocodice();
        $num = explode("evento", $ultimo_cod[0]);
        $num = $num[1]+1;
        $id_ultimo = 'evento'.($num);
        $nome_evento = $_POST['nome_evento'];
        $img = $_POST['path_immagine']."\\".$_POST['nome_immagine'];
        $eventi = "";
        if($nome_evento != "" && $img != ""){
            $evento = new EEvento($id_ultimo, $img, $nome_evento, $eventi);
            //inserimento
            if($operazione == 'inserimento'){
                $stored = $db->store($evento);
                if($stored){
                    echo '<script type="text/javascript">
                            alert("inserimento avvenuto")
                            window.location= "/TicketStore/validazione"
                          </script>'; 
                } 
            }   
        }else{
                echo '<script type="text/javascript">
                            alert("Bisogna riempire tutti i campi correttamente")
                            window.location= "/TicketStore/validazione"
                          </script>'; 
         }
        }
        if($tabella == 'evento' && $operazione != 'inserimento') {   
            $id = $_POST['codice_evento'];
            $nome_evento = $_POST['nome_evento'];
            $img = $_POST['path_immagine']."\\".$_POST['nome_immagine'];
            $eventi = "";
            if($id != ""){
            $evento = new EEvento($id, $img, $nome_evento, $eventi);
            if($operazione == 'cancellazione'){
                $deleted = $db->delete($evento);
                if($deleted){
                    echo '<script type="text/javascript">
                            alert("la cancellazione è avvenuta correttamente")
                            window.location= "/TicketStore/validazione"
                          </script>'; 
                }
            }
        }
        else {
            echo '<script type="text/javascript">
                        alert("Bisogna riempire tutti i campi correttamente")
                        window.location= "/TicketStore/validazione"
                      </script>';
        }
        
        
        
            //modifica
            if(($operazione == 'modifica')){
                if($id != "" && $nome_evento != "" && $img != ""){
                    $evento = new EEvento($id, $img, $nome_evento, $eventi);
                    $update = $db->update($evento);
                    if($update){
                        echo '<script type="text/javascript">
                                alert("Modifica avvenuta")
                                window.location= "/TicketStore/validazione"
                              </script>'; 
                    } 
                }
                else {
                    echo '<script type="text/javascript">
                                alert("Bisogna riempire tutti i campi correttamente")
                                window.location= "/TicketStore/validazione"
                              </script>';
                }
            }
        }
        
        
             
    
        
    
         
        
        
        
        //----------------------------gestione utente_r------------------------------------------------------
        if($tabella == 'utente_r') {
        $mail = $_POST['mail'];
        if($mail != ""){
            $utente = new EUtente_Reg("", "", $mail, "");
            if($operazione == 'cancellazione'){
                $deleted = $db->delete($utente);
                if($deleted){
                echo '<script type="text/javascript">
                        alert("la cancellazione è avvenuta correttamente")
                        window.location= "/TicketStore/validazione"
                      </script>'; 
                }
            }
        }
        else{
            echo '<script type="text/javascript">
                        alert("Bisogna riempire tutti i campi correttamente")
                        window.location= "/TicketStore/validazione"
                      </script>';
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
        
        
        if($codes != "" && $data != ""){
            if($operazione == 'cancellazione'){
                $deleted = $db->delete_es($codes,$data);
                var_dump($deleted);
                if($deleted){
                    echo '<script type="text/javascript">
                            alert("la cancellazione è avvenuta correttamente")
                            window.location= "/TicketStore/validazione"
                          </script>'; 
                }
                else{
                    echo '<script type="text/javascript">
                            alert("Assicurarsi che tutte le partecipazioni relative all evento che si desidera cancellare siano cancellate")
                            window.location= "/TicketStore/validazione"
                          </script>'; 
                }
            }
        }
        else{
            echo '<script type="text/javascript">
                        alert("Bisogna riempire tutti i campi correttamente")
                        window.location= "/TicketStore/validazione"
                      </script>';
        }
        
        if($tipo != "" && $data != "" && $luogo != "" && $codes != ""){
            if($operazione == 'inserimento'){
               $stored = $db->store_es($codes,$data,$luogo,$tipo,$casa,$ospite,$compagnia,$artista);
               if($stored){
                    echo '<script type="text/javascript">
                            alert("inserimento avvenuto")
                            window.location= "/TicketStore/validazione"
                          </script>'; 
                }
            } 
            
            //modifica
            if(($operazione == 'modifica')){
                $update = $db->update_es($codes,$data,$luogo,$tipo,$casa,$ospite,$compagnia,$artista);
                if($update){
                echo '<script type="text/javascript">
                        alert("Modifica avvenuta")
                        window.location= "/TicketStore/validazione"
                      </script>'; 
                }
            }
        }
        else{
            echo '<script type="text/javascript">
                        alert("Bisogna riempire tutti i campi correttamente")
                        window.location= "/TicketStore/validazione"
                      </script>';
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
                if($stored){
                    echo '<script type="text/javascript">
                            alert("inserimento avvenuto")
                            window.location= "/TicketStore/validazione"
                          </script>'; 
                }
            }
            
            
            if(($operazione == 'modifica')){
                $updated = $db->update_partecipazione($codep, $datap, $zona, $indirizzop, $prezzo);
                    if($updated){
                        echo '<script type="text/javascript">
                                alert("Modifica avvenuta")
                                window.location= "/TicketStore/validazione"
                              </script>'; 
                    }
                }
               
            
            if($operazione == 'cancellazione'){
                $deleted = $db->delete_partecipazione($codep,$datap,$zona,$indirizzop,$prezzo);
                var_dump($deleted);
                if($deleted){
                    echo '<script type="text/javascript">
                            alert("la cancellazione è avvenuta correttamente")
                            window.location= "/TicketStore/validazione"
                          </script>'; 
                }
                else{
                    echo '<script type="text/javascript">
                            alert("Sono presenti errori di sintassi in qualcuno dei campi inseriti.Coreggere e Riprovare")
                            window.location= "/TicketStore/validazione"
                          </script>'; 
                }
            }
        }
        else{
            echo '<script type="text/javascript">
                        alert("Bisogna riempire tutti i campi correttamente")
                        window.location= "/TicketStore/validazione"
                      </script>';
            }
        }
//----------------------------gestione zona------------------------------------------------------
        if($tabella == 'zona'){
            $nomez = $_POST['zona'];
            $indirizzoz = $_POST['indirizzoz'];
            
            if($nomez != "" && $indirizzoz != ""){
                if($operazione == 'inserimento'){
                    $capacita = $_POST['capacita'];
                    $stored = $db->storezona($nomez, $indirizzoz, $capacita);
                    if($stored){
                        echo '<script type="text/javascript">
                            alert("inserimento avvenuto")
                            window.location= "/TicketStore/validazione"
                          </script>'; 
                    }
                }
                
                if ($operazione == 'modifica'){
                    $capacita = $_POST['capacita'];
                    $updated = $db->updatezona($nomez, $indirizzoz, $capacita);
                    if($updated){
                            echo '<script type="text/javascript">
                                    alert("Modifica avvenuta")
                                    window.location= "/TicketStore/validazione"
                                  </script>'; 
                    }
                }        
                if($operazione == 'cancellazione'){
                     $deleted = $db->deletezona($nomez, $indirizzoz);
                     if($deleted){
                         echo '<script type="text/javascript">
                                alert("cancellazione avvenuta")
                                window.location= "/TicketStore/validazione"
                               </script>'; 
                        }
                    }
                }
                 else{
                    echo '<script type="text/javascript">
                                alert("Bisogna riempire tutti i campi correttamente")
                                window.location= "/TicketStore/validazione"
                              </script>';
                }
        }
//----------------------------gestione biglietto------------------------------------------------------
        if($tabella == 'biglietti'){
          $num = (int)$_POST['numero_bigl'];
          $nome_evento = $_POST['nome_evento'];
          $data = $_POST['data'];
          $zona = $_POST['zona'];
          $code = $_POST['codice_evento'];
          $indirizzo = $_POST['indirizzo'];
          
         
         if(is_int($num) && $nome_evento != "" && $data != "" && $zona != "" && $code != "" && $indirizzo != ""){
                if($operazione == 'inserimento'){
                    $stored = $db->store_bigl($num,$nome_evento,$data,$zona,$code,$indirizzo);
                   
                    if($stored){
                        echo '<script type="text/javascript">
                                alert("inserimento avvenuto")
                                window.location= "/TicketStore/validazione"
                              </script>'; 
                    }
                }
            } 
            else{
                    echo '<script type="text/javascript">
                                alert("Bisogna riempire tutti i campi correttamente")
                                window.location= "/TicketStore/validazione"
                              </script>';
            }  
        }
              
    }  
}


