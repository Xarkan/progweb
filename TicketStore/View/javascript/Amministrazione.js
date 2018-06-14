function getAndFill() {
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
}


function setTableEvento(){
    var x = document.getElementById("table").selectedIndex;
    var y = document.getElementById("table").options;
    //tabella.options.value
    if(y[x].index == 1){
        let html_command = '<legend>Dati da inserire/modificare/cancellare-evento</legend>'+
                       '<table>'+
                            '<tr>'+
                            '<td id="ultimo"></td>'+
                            '<td>codice_evento<br><input type="text" name="codice_evento"></td>'+
                            '<td>nome<br><input type="text" name="nome_evento"></td>'+
                            '<td>path_immagine<br><input type="text" readonly name="path_immagine" value=".\\View\\imgs"></td>'+
                            '<td>nome_immagine<br><input type="text" name="nome_immagine"></td>'+
                            '</tr>'+
                       '</table>';
        document.getElementById('sezione').innerHTML = html_command;
                           
    }
    if(y[x].index == 2){
        let html_command = '<legend>Cancellazione-utente_r</legend>'+
                                '<table>'+
                                    '<tr>'+
                                        '<td>mail<br>'+
                                            '<input type="email" name="mail" id="mail">'+
                                        '</td>'+
                                    '</tr>'+
                                '</table>';
        document.getElementById('sezione').innerHTML = html_command;
    }
    if(y[x].index == 3){
        let html_command = '<legend>Dati da inserire/modificare/cancellare-evento_specifico</legend>'+
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
                            '</table>';
                
        document.getElementById('sezione').innerHTML = html_command;        
                
    }
    if(y[x].index == 4){
        let html_command = '<legend>Dati da inserire/modificare/cancellare-partecipazioni</legend>'+
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


    
}



