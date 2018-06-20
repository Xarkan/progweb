function getAndFill() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var risposta = JSON.parse(xmlhttp.responseText);
        setTable(risposta);
        
    }
};
    xmlhttp.open("POST","/TicketStore/ricerca", true);
    xmlhttp.send();
}


function setTable(risposta) {
    var table = '';
    var rest = risposta.length;
    var k = 0;
    while(rest > 0) {
        table += '<div class="row">';
        for (let c = 0; c < 6 && c < rest; c++) {
            let html_command = '<div class="card">' +
            '<a href="/TicketStore/evento/'+ risposta[k].id +'">' +
            '<img class="card-img-top" src="/TicketStore/'+ risposta[k].img+'" alt="Card image cap"></a>' +
            '<div class="card-body"><p class="card-text">'+risposta[k].nome+'</p></div></div>';
            table += '<div class="col">' + html_command + '</div>';   
            k++; 
        }
        rest = rest - 6;
        table += '</div>';
    }
    document.getElementById("cards-block").innerHTML = table;
}
