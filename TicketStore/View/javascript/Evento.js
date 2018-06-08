
function fillLuogoData() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var risposta = JSON.parse(xmlhttp.responseText);
        setTable(risposta);
        //document.getElementById("cards-block").innerHTML = xmlhttp.responseText;
    }
};
    xmlhttp.open("GET","/TicketStore/home", true);
    xmlhttp.send();
}



function setTable(risposta) {
    
    var table = '';
    var url =  window.location.href;
    var splitted_url = url.split("/");
    var codice = splitted_url[splitted_url.length - 1];
    
    for(let i = 0; i < risposta[codice].eventi.length ; i++) {
        let html_command = '<tr><td>'+risposta[codice].eventi[i].data+'</td>'+
            '<td>'+risposta[codice].eventi[i].luogo.citta+'</td>'+
            '<td>'+risposta[codice].eventi[i].luogo.struttura+'</td>'+
            '<td>'+risposta[codice].eventi[i].luogo.via+'</td>'+
            '<td>'+risposta[codice].eventi[i].partecipazioni[0].prezzo+'</td>'+
            '<td><a type="button" class="btn btn-warning" href="/TicketStore/zone/'+codice+'/'+i+'">Acquista</a></td></tr>';
        table = table + html_command;    
    }
    document.getElementById("table-section").innerHTML = table;
    let html_command_nome = '<h4>'+risposta[codice].nome+'</h4>';
    document.getElementById("nome").innerHTML = html_command_nome;
    let html_command_immagine = '<img src=/TicketStore/'+risposta[codice].img+' class="img-fluid" alt="Responsive image">';
    document.getElementById("immagine").innerHTML = html_command_immagine;

}   
