
function getAndFill() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var risposta = JSON.parse(xmlhttp.responseText);
            setTable(risposta);
    }
};
    xmlhttp.open("GET","/TicketStore/Json/biglietto", true);
    xmlhttp.send();
}


function setTable(risposta) {
    var table = '';
    
    for(let i = 0; i < risposta.length; i++) {  
        let array = risposta[i].indirizzo.split(", ");
        let html = '<div class="container">'+
        '<div class="alert alert-primary" role="alert">TicketStore</div>'+
        '<img src="Deep.jpg" id="image">'+          
        '<h1 class="display-4" id="Titolo-bigl"><b>'+risposta[i].evento+'</b></h1>'+
        '<img src="codice-a-barre.jpg" id="codice-barre">'+
        '<pre id="dettagli-bigl">'+
            '<b>CITTA : </b>'+array[0]+
            '<b>STRUTTURA : </b>'+array[1]+
            '<b>DATA : </b>'+risposta[i].data_evento+
            '<b>ORA : </b>questo è un problema'+
            '<b>NOME E COGNOME : </b>questo pure'+
            '<b>CODICE : </b>'+risposta[i].codb+'</pre>'+
        '</div>';

        table = table + html;
    }
    document.getElementById("biglietto").innerHTML = table;
}

