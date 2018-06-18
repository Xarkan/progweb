/*function getAndFill() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var risposta = JSON.parse(xmlhttp.responseText);
        setcodice(risposta);
        
    }
};
    xmlhttp.open("GET","/TicketStore/Amministrazione", true);
    xmlhttp.send();
}

function setcodice(risposta){
    let html_command = '<p>il codice inserito per ultimo è :<br> ' +risposta+'</p>';
    document.getElementById('ultimo').innerHTML = html_command;
}*/


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
                            '<td>nome<br><input type="text" name="nome_evento"></td>'+
                            '<td>path_immagine<br><input type="text" readonly name="path_immagine" value=".\\View\\imgs"></td>'+
                            '<td>nome_immagine<br><input type="text" name="nome_immagine"></td>'+
                            '</tr>'+
                       '</table>';
        document.getElementById('sezione').innerHTML = html_command;
                           
    }
    //modifica
    if(y[x].index == 1 && j[i].index == 2){
        let html_command = '<legend>Modifica di un evento nel database</legend>'+
                       '<table>'+
                            '<tr>'+
                            '<td>codice_evento<br><input type="text" name="codice_evento"></td>'+
                            '<td>nome<br><input type="text" name="nome_evento"></td>'+
                            '<td>path_immagine<br><input type="text" readonly name="path_immagine" value=".\\View\\imgs"></td>'+
                            '<td>nome_immagine<br><input type="text" name="nome_immagine"></td>'+
                            '</tr>'+
                       '</table>';
        document.getElementById('sezione').innerHTML = html_command;
                           
    }
    //cancellazione qui dobbiamo gestire la cancellazione delle foreign key
    if(y[x].index == 1 && j[i].index == 3){
        let html_command = '<legend>Cancellazione di un evento dal database</legend>'+
                       '<table>'+
                            '<tr>'+
                            '<td>codice_evento<br><input type="text" name="codice_evento"></td>'+
                            '<td>nome<br><input type="text" readonly name="nome_evento"></td>'+
                            '<td>path_immagine<br><input type="text" readonly name="path_immagine" value=".\\View\\imgs"></td>'+
                            '<td>nome_immagine<br><input type="text" readonly name="nome_immagine"></td>'+
                            '</tr>'+
                       '</table>';
        document.getElementById('sezione').innerHTML = html_command;
                           
    }
    
    
//----------------------------------operazioni su utente_r--------------------------------------------------------------------------------------    
     
    //inserimento e modifica
    if(y[x].index == 2 && (j[i].index == 1 || j[i].index == 2)){
        let html_command = '<legend>Spiacente, Non sei autorizzato a questo tipo di operazione</legend>';
                                
        document.getElementById('sezione').innerHTML = html_command;
    }
    
    //cancellazione
    if(y[x].index == 2 && j[i].index == 3){
        let html_command = '<legend>Cancellazione di un utente registrato dal database</legend>'+
                                '<table>'+
                                    '<tr>'+
                                        '<td>mail<br>'+
                                            '<input type="email" name="mail" id="mail">'+
                                        '</td>'+
                                    '</tr>'+
                                '</table>';
        document.getElementById('sezione').innerHTML = html_command;
    }
    
    
//----------------------------------operazioni su evento_specifico--------------------------------------------------------------------------------------    
    //inserimento
    if(y[x].index == 3 && j[i].index == 1){
        let html_command = '<legend>Inserimento di un evento specifico nel database</legend>'+
                            '<table>'+
                                '<tr>'+
                                    '<td>codice_evento<input type="text" name="codes"></td>'+
                                    '<td>data_evento<input type="date" name="data_es"></td>'+
                                    '<td>indirizzo<input type="text" name="indirizzo"></td>'+
                                    '<td>Tipo <select name="tipo">'+

                                             '<option></option>'+
                                             '<option>Partita</option>'+
                                             '<option>Spettacolo</option>'+
                                             '<option>Concerto</option>'+

                                         '</select>'+
                                    '</td>'+
                                    '<td>Casa<input type="text" name="casa"></td>'+
                                    '<td>Ospite<input type="text" name="ospite"></td>'+
                                    '<td>Compagnia<input type="text" name="compagnia"></td>'+
                                    '<td>Artista<input type="text" name="artista"></td>'+
                                '</tr>'+
                            '</table>'+
                            '<legend>Prima di inserire un nuovo evento specifico, assicurati che sia già stato<br>'+
                            'inserito un evento generico che abbia lo stesso codice che stai inserendo,<br>'+
                            'altrimenti l operazione di inserimento ti sarà negata</legend>';  
                
        document.getElementById('sezione').innerHTML = html_command;        
                
    }
    
    //modifica
    if(y[x].index == 3 && j[i].index == 2){
        let html_command = '<legend>Modifica di un evento specifico nel database</legend>'+
                            '<table>'+
                                '<tr>'+
                                    '<td>codice_evento<input type="text" name="codes"></td>'+
                                    '<td>data_evento<input type="date" name="data_es"></td>'+
                                    '<td>indirizzo<input type="text" name="indirizzo"></td>'+
                                    '<td>Tipo <select name="tipo">'+

                                             '<option></option>'+
                                             '<option>Partita</option>'+
                                             '<option>Spettacolo</option>'+
                                             '<option>Concerto</option>'+

                                         '</select>'+
                                    '</td>'+
                                    '<td>Casa<input type="text" name="casa"></td>'+
                                    '<td>Ospite<input type="text" name="ospite"></td>'+
                                    '<td>Compagnia<input type="text" name="compagnia"></td>'+
                                    '<td>Artista<input type="text" name="artista"></td>'+
                                '</tr>'+
                            '</table>'+
                            '<legend>Per modificare correttamente un evento specifico bisogna procedere seguendo queste regole<br>'+
                            '<ul><li>INSERIRE IL CODICE E LA DATA RELATIVI ALL EVENTO DA MODIFICARE</li>'+
                            '<li>EFFETTUARE LE MODIFICHE PREVISTE</li>'+
                            '<li>I CAMPI NON MODIFICATI DEVONO CONTENERE IL VALORE GIA PRESENTE NEL DATABASE</li></ul><br>'+
                            'BUON LAVORO!!</legend>';
                
        document.getElementById('sezione').innerHTML = html_command;        
                
    }
    
    //cancellazione
    if(y[x].index == 3 && j[i].index == 3){
        let html_command = '<legend>Cancellazione di un evento specifico dal database</legend>'+
                            '<table>'+
                                '<tr>'+
                                    '<td>codice_evento<input type="text" name="codes"></td>'+
                                    '<td>data_evento<input type="date" name="data_es"></td>'+
                                    '<td>indirizzo<input type="text" readonly name="indirizzo"></td>'+
                                    '<td>Tipo <select name="tipo" readonly>'+

                                             '<option></option>'+

                                         '</select>'+
                                    '</td>'+
                                    '<td>Casa<input type="text" readonly name="casa"></td>'+
                                    '<td>Ospite<input type="text" readonly name="ospite"></td>'+
                                    '<td>Compagnia<input type="text" readonly name="compagnia"></td>'+
                                    '<td>Artista<input type="text" readonly name="artista"></td>'+
                                '</tr>'+
                            '</table>';
                
        document.getElementById('sezione').innerHTML = html_command;        
                
    }
    
    
//----------------------------------operazioni su partecipazioni--------------------------------------------------------------------------------------        
    //inserimento
    if(y[x].index == 4 && j[i].index == 1){
        let html_command = '<legend>Inserimento di una partecipazione nel database</legend>'+
                            '<table>'+
                                '<tr>'+
                                    '<td>codice_evento<br><input type="text" name="codep"></td>'+
                                    '<td>data_evento<br><input type="date" name="datap"></td>'+
                                    '<td>zona<br><input type="text" name="zona"></td>'+
                                    '<td>indirizzo<br><input type="text" name="indirizzop"></td>'+
                                    '<td>prezzo<br><input name="prezzo"></td>'+
                                '</tr>'+
                            '</table>';
                
        document.getElementById('sezione').innerHTML = html_command;        
    }
    
    //modifica
    if(y[x].index == 4 && j[i].index == 2){
        let html_command = '<legend>Modifica di una partecipazione nel database</legend>'+
                            '<table>'+
                                '<tr>'+
                                    '<td>codice_evento<br><input type="text" name="codep"></td>'+
                                    '<td>data_evento<br><input type="date" name="datap"></td>'+
                                    '<td>zona<br><input type="text" name="zona"></td>'+
                                    '<td>indirizzo<br><input type="text" name="indirizzop"></td>'+
                                    '<td>prezzo<br><input name="prezzo"></td>'+
                                '</tr>'+
                            '</table>'+
                            '<legend>Per modificare correttamente una partecipazione bisogna procedere seguendo queste regole<br>'+
                            '<ul><li>INSERIRE IL CODICE E LA DATA RELATIVI ALLA PARTECIPAZIONE DA MODIFICARE</li>'+
                            '<li>EFFETTUARE LE MODIFICHE PREVISTE</li>'+
                            '<li>I CAMPI NON MODIFICATI DEVONO CONTENERE IL VALORE GIA PRESENTE NEL DATABASE</li></ul><br>'+
                            'BUON LAVORO!!</legend>';
                
        document.getElementById('sezione').innerHTML = html_command;        
    }
    
    //cancellazione
    if(y[x].index == 4 && j[i].index == 3){
        let html_command = '<legend>Cancellazione di una partecipazione nel database</legend>'+
                            '<table>'+
                                '<tr>'+
                                    '<td>codice_evento<br><input type="text" name="codep"></td>'+
                                    '<td>data_evento<br><input type="date" name="datap"></td>'+
                                    '<td>zona<br><input type="text" name="zona"></td>'+
                                    '<td>indirizzo<br><input type="text" name="indirizzop"></td>'+
                                    '<td>prezzo<br><input name="prezzo"></td>'+
                                '</tr>'+
                            '</table>';
                
        document.getElementById('sezione').innerHTML = html_command;        
    }
//----------------------------------operazioni su zona--------------------------------------------------------------------------------------   
//inserimento
    if(y[x].index == 5 && j[i].index == 1){
        let html_command = '<legend>Inserimento di una zona nel database</legend>'+
                            '<table>'+
                                '<tr>'+
                                    '<td>nome<br><input type="text" name="zona"></td>'+
                                    '<td>indirizzo<br><input type="text" name="indirizzoz"></td>'+
                                    '<td>capacita<br><input type="text" name="capacita"></td>'+
                                '</tr>'+
                            '</table>';
                
        document.getElementById('sezione').innerHTML = html_command;
    } 

//modifica
    if(y[x].index == 5 && j[i].index == 2){
        let html_command = '<legend>Modifica di una zona nel database</legend>'+
                            '<table>'+
                                '<tr>'+
                                    '<td>nome<br><input type="text" name="zona"></td>'+
                                    '<td>indirizzo<br><input type="text" name="indirizzoz"></td>'+
                                    '<td>capacita<br><input type="text" name="capacita"></td>'+
                                '</tr>'+
                            '</table>'+
                            '<legend>Per modificare correttamente una zona bisogna procedere seguendo queste regole<br>'+
                            '<ul><li>INSERIRE IL NOME E L INDIRIZZO RELATIVI ALLA ZONA DA MODIFICARE</li>'+
                            '<li>EFFETTUARE LE MODIFICHE PREVISTE</li>'+
                            '<li>I CAMPI NON MODIFICATI DEVONO CONTENERE IL VALORE GIA PRESENTE NEL DATABASE</li></ul><br>'+
                            'BUON LAVORO!!</legend>';
                
        document.getElementById('sezione').innerHTML = html_command;
    }           
    
//cancellazione
    if(y[x].index == 5 && j[i].index == 3){
        let html_command = '<legend>Cancellazione di una zona nel database</legend>'+
                            '<table>'+
                                '<tr>'+
                                    '<td>nome<br><input type="text" name="zona"></td>'+
                                    '<td>indirizzo<br><input type="text" name="indirizzoz"></td>'+
                                '</tr>'+
                            '</table>';
                
        document.getElementById('sezione').innerHTML = html_command;
}

}

