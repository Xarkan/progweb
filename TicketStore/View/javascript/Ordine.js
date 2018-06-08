
function getAndFill() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var risposta = JSON.parse(xmlhttp.responseText);
        setDettagli(risposta);
        setTable(risposta);
    }
};
    xmlhttp.open("GET","/TicketStore/ordine/json", true);
    xmlhttp.send();
}


function setTable(risposta) {
    var table = '';

    for(let i = 0; i < risposta.partecipazioni.length ; i++) {
        let html = '<div class="biglietti">'+
                '<ul>'+
                    '<li>Zona: '+risposta.partecipazioni[i].zona+'</li>'+
                    '<li>Posto: '+risposta.partecipazioni[i].posto+'</li>'+
                    '<li>Prezzo: '+risposta.partecipazioni[i].prezzo+'</li>'+
                    '<li><button type="button" class="btn btn-warning">X</button></li>' +   
                '</ul>'+    
            '</div>';
        table = table + html; 
    }
    document.getElementById("items").innerHTML = table;
    
}

function setDettagli(risposta) {
    let html = '<li><h4>'+risposta.nome+'</h4></li>'+
                '<li><h6>'+risposta.data+'</h6></li>'+
                '<li><h6>'+risposta.citta+'</h6></li>'+
                '<li><h6>'+risposta.struttura+'</h6></li>'+
                '<li><h6>'+risposta.via+'</h6></li>';
    
    document.getElementById("dettagli").innerHTML = html;
    let path_img = '<img src="'+risposta.img+'" class="img-fluid" alt="Responsive image" id="side-img">';
    document.getElementById("box-img").innerHTML = path_img;
}        