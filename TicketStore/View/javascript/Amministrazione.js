function setTableEvento(){
    var x = document.getElementById("table").selectedIndex;
    var y = document.getElementById("table").options;
    
    var i = document.getElementById("operazione").selectedIndex;
    var j = document.getElementById("operazione").options;
    
//----------------------------------operazioni su evento--------------------------------------------------------------------------------------
    //inserimento
    if(y[x].index == 1 && j[i].index == 1){
        let html_command = '<legend>Inserimento di un evento nel database</legend>'+
                       '<table>'+
                            '<tr>'+
                            '<td>nome_evento<br><input type="text" name="nome_evento" required></td>'+
                            '<td>nome_immagine<br><input type="text" name="nome_immagine" required></td>'+
                            '</tr>'+
                            '<tr>'+                                    
                                    '<td>data_evento<br><input type="date" name="data_es" required></td>'+
                                    '<td>ora_evento<br><input type="time" name="ora_es" required></td>'+
                                    '<td>Tipo<br><select name="tipo" required>'+

                                             '<option></option>'+
                                             '<option>Partita</option>'+
                                             '<option>Spettacolo</option>'+
                                             '<option>Concerto</option>'+

                                         '</select>'+
                                    '</td>'+
                            '</tr>'+
                            '<tr>'+
                                    '<td>Casa<br><input type="text" name="casa" ></td>'+
                                    '<td>Ospite<br><input type="text" name="ospite" ></td>'+
                                    '<td>Compagnia<br><input type="text" name="compagnia" ></td>'+
                                    '<td>Artista<br><input type="text" name="artista" ></td>'+
                            '</tr>'+        
                                '</tr>'+
                                '<tr>'+
                                    '<td>citta<br><input type="text" name="citta" required></td>'+
                                    '<td>struttura<br><input name="struttura" required></td>'+
                                '</tr>'+
                                '<tr>'+
                                    '<td>zona<br><input type="text" name="zona" required></td>'+
                                    '<td>capacita<br><input type="text" name="capacita" required></td>'+
                                    '<td>prezzo<br><input type="text" name="prezzo" required></td>'+
                                '</tr>'+
                            '</table>'+
                       '</table>';
        document.getElementById('sezione').innerHTML = html_command;
        
}
    if(y[x].index == 1 && j[i].index == 2){
        let html_command = '<legend>Cancellazione di un evento dal database</legend>'+
                       '<table>'+
                            '<tr>'+
                            '<td>codice_evento<br><input type="text" name="code" required></td>'+
                            '<td>nome<br><input type="text" name="nome_evento" required></td>'+
                            '</tr>'+
                       '</table>';
        document.getElementById('sezione').innerHTML = html_command;
        
                           
    }
    
    
//----------------------------------operazioni su utente_r--------------------------------------------------------------------------------------    
     
    //inserimento
    if(y[x].index == 2 && j[i].index == 1){
        let html_command = '<legend>Spiacente, Non sei autorizzato a questo tipo di operazione</legend>'+
                           '<input hidden="hidden" type="text" name="code" required>';
                                
        document.getElementById('sezione').innerHTML = html_command;
        
    }
    
    //cancellazione
    if(y[x].index == 2 && j[i].index == 2){
        let html_command = '<legend>Cancellazione di un utente registrato dal database</legend>'+
                                '<table>'+
                                    '<tr>'+
                                        '<td>mail<br>'+
                                            '<input type="email" name="mail" id="mail" required>'+
                                        '</td>'+
                                    '</tr>'+
                                '</table>';
        document.getElementById('sezione').innerHTML = html_command;
    }
    
    
//----------------------------------operazioni su evento_specifico--------------------------------------------------------------------------------------    
    //inserimento
    if(y[x].index == 3 && j[i].index == 1){
        let html_command = '<legend>Inserimento di un evento specifico nel database</legend>'+
                           '<legend>ATTENZIONE IL CODICE DA INSERIRE DEVE RIFERIRSI AD UN EVENTO GENERICO GIA PRESENTE NEL DB</legend>'+
                            '<table>'+
                                '<tr>'+
                                    '<td>codice_evento<br><input type="text" name="code" required></td>'+
                                    '<td>nome_evento<br><input type="text" name="nome_evento" required></td>'+
                                    '<td>data_evento<br><input type="date" name="data_es" required></td>'+
                                    '<td>ora_evento<br><input type="time" name="ora_es" required></td>'+
                                    '<td>Tipo<br><select name="tipo" required>'+

                                             '<option></option>'+
                                             '<option>Partita</option>'+
                                             '<option>Spettacolo</option>'+
                                             '<option>Concerto</option>'+

                                         '</select>'+
                                    '</td>'+
                            '</tr>'+
                            '<tr>'+
                                    '<td>Casa<br><input type="text" name="casa"></td>'+
                                    '<td>Ospite<br><input type="text" name="ospite"></td>'+
                                    '<td>Compagnia<br><input type="text" name="compagnia"></td>'+
                                    '<td>Artista<br><input type="text" name="artista"></td>'+
                            '</tr>'+        
                                '</tr>'+
                                '<tr>'+
                                    '<td>citta<br><input type="text" name="citta" required></td>'+
                                    '<td>struttura<br><input name="struttura" required></td>'+
                                '</tr>'+
                                '<tr>'+
                                    '<td>zona<br><input type="text" name="zona" required></td>'+
                                    '<td>capacita<br><input type="text" name="capacita" required></td>'+
                                    '<td>prezzo<br><input type="text" name="prezzo" required></td>'+
                                '</tr>'+
                       '</table>';
        document.getElementById('sezione').innerHTML = html_command;        
                
    }
    
    //cancellazione
    if(y[x].index == 3 && j[i].index == 2){
        let html_command = '<legend>Cancellazione di un evento specifico dal database</legend>'+
                            '<table>'+
                                '<tr>'+
                                    '<td>codice_evento<input type="text" name="code" required></td>'+
                                    '<td>data_evento<input type="date" name="data_es" required></td>'+
                                    '<td>ora_evento<input type="time" name="ora_es" required></td>'+
                                    '<td>citta<input type="text" name="citta" required></td>'+
                                    '<td>struttura<input type="text" name="struttura" required></td>'+
                            '</table>';
                
        document.getElementById('sezione').innerHTML = html_command;        
                
    }
    
    
//----------------------------------operazioni su partecipazioni--------------------------------------------------------------------------------------        
    //inserimento
    if(y[x].index == 4 && j[i].index == 1){
        let html_command = '<legend>Inserimento di una partecipazione nel database</legend>'+
                            '<table>'+
                                '<tr>'+
                                    '<td>codice_evento<br><input type="text" name="code" required></td>'+
                                    '<td>data_evento<br><input type="date" name="data_es" required></td>'+
                                    '<td>ora_evento<br><input type="time" name="ora_es" required></td>'+
                                    
                            '</tr>'+
                                 
                                
                                '<tr>'+
                                    '<td>citta<br><input type="text" name="citta" required></td>'+
                                    '<td>struttura<br><input name="struttura" required></td>'+
                                '</tr>'+
                                '<tr>'+
                                    '<td>zona<br><input type="text" name="zona" required></td>'+
                                    '<td>capacita<br><input type="text" name="capacita" required></td>'+
                                    '<td>prezzo<br><input type="text" name="prezzo" required></td>'+
                                '</tr>'+
                       '</table>';
                
        document.getElementById('sezione').innerHTML = html_command;        
    }
    
    
    //cancellazione
    if(y[x].index == 4 && j[i].index == 2){
        let html_command = '<legend>Cancellazione di una partecipazione nel database</legend>'+
                            '<table>'+
                                '<tr>'+
                                    '<td>codice_evento<br><input type="text" name="code" required></td>'+
                                    '<td>data_evento<br><input type="date" name="data_es" required></td>'+
                                    '<td>ora_evento<br><input type="time" name="ora_es" required></td>'+                              
                                    '<td>citta<br><input type="text" name="citta" required></td>'+
                                    '<td>struttura<br><input type="text" name="struttura" required></td>'+
                                    '<td>zona<br><input type="text" name="zona" required></td>'+
                                '</tr>'+
                            '</table>';
                
        document.getElementById('sezione').innerHTML = html_command;        
    }

//----------------------------------operazioni su biglietto--------------------------------------------------------------------------------------   
    //inserimento biglietti 
    if(y[x].index == 5 && j[i].index == 1){
        let html_command = '<legend>Inserimento di biglietti acquistabili nel database</legend>'+
                            '<legend>ATTENZIONE INSERIRE UNA ZONA GIA ESISTENTE</legend>'+
                            '<table>'+
                                '<tr>'+
                                    '<td>codice_evento<br><input type="text" name="code" required></td>'+
                                    '<td>data<br><input type="date" name="data_es" required></td>'+
                                    '<td>ora_evento<br><input type="time" name="ora_es" required></td>'+
                                    '<td>citta<br><input type="text" name="citta" required></td>'+
                                    '<td>struttura<br><input type="text" name="struttura" required></td>'+
                                    '<td>nome_evento<br><input type="text" name="nome_evento" required></td>'+
                                    '<td>numero_bigl<br><input type="number" name="capacita" required></td>'+
                                    '<td>zona<br><input type="text" name="zona" required></td>'+
                                '</tr>'+
                            '</table>';
                          
        document.getElementById('sezione').innerHTML = html_command;
}
    
    if(y[x].index == 5 && j[i].index == 2){
        let html_command = '<legend>Spiacente, Non sei autorizzato a questo tipo di operazione</legend>'+
                            '<input hidden="hidden" type="text" name="code" required>';
                                
        document.getElementById('sezione').innerHTML = html_command;
         
    }
}