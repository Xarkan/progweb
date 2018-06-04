
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
    for(let i = 0; i < risposta[codice].length; i++) {
        let html_command = '<tr><th scope="row">'+risposta[codice][i].data+'</th>'+
            '<td>'+risposta[codice][i].citta+'</td>'+
            '<td>'+risposta[codice][i].struttura+'</td>'+
            '<td>'+risposta[codice][i].via+'</td>'+
            '<td>'+risposta[codice][i].prezzo+'</td>'+
            '<td><a type="button" class="btn btn-warning" href="#">Acquista</a></td></tr>';
        table += table + html_command;    
    }
    document.getElementById("table-section").innerHTML = table;
}