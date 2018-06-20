
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
        let html = '<div id="b-header">TicketStore</div>'+
      '    <div id="b-main">'+
      '        <div id="b-evento">'+
      '          <ul>'+
      '              <li><h4>'+risposta[i].evento+'</h4></li>'+
      '              <li><h5>'+risposta[i].data_evento+'</h5></li>'+
      '              <li><h5>'+array[0]+'</h5></li>'+
      '              <li><h5>'+array[1]+'</h5></li>'+     
      '          </ul>   '+ 
      '        </div>'+
      '        <div id="b-dettagli">'+
      '            <ul>'+
      '              <li><h6>zona: '+risposta[i].zona+'</h6></li>'+
      '              <li><h6>fila: '+risposta[i].fila+'</h6></li>'+
      '              <li><h6>posto: '+risposta[i].posto+'</h6></li>'+
      '            </ul>'+
      '        </div>'+
      '        <div id="b-utente">'+
      '              <ul>'+
      '                  <li><h6>'+risposta[i].mail+'</h6></li>'+
      '                  <li><h6>prezzo??</h6></li>'+
      '              </ul>'+
      '        </div>'+
      '        <div id="codice">'+risposta[i].codb+'</div>'+
      '    </div>';
        

        table = table + html;
    }
    document.getElementById("biglietto").innerHTML = table;
}



/*let html = '<div class="container">'+
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
        '</div>';*/