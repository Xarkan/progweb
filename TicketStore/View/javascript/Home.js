
function getAndFill() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var risposta = JSON.parse(xmlhttp.responseText);
        setTable(risposta);
        setCarousel(risposta);
    }
};
    xmlhttp.open("GET","/TicketStore/home", true);
    xmlhttp.send();
}


function setTable(risposta) {
    var table = '';
    var rest = risposta.length;
    var k = 0;
    while(rest > 0) {
        table += '<div class="row">';
        for (let c = 0; c < 3 && c < rest; c++) {
            let html_command = '<div class="card" style="width: 18rem;">' +
            '<a href="/TicketStore/evento/'+ k +'">' +
            '<img class="card-img-top" src="/TicketStore/'+ risposta[k].img+'" alt="Card image cap"></a>' +
            '<div class="card-body"><p class="card-text">'+risposta[k].nome+'</p></div></div>';
            table += '<div class="col">' + html_command + '</div>';   
            k++; 
        }
        rest = rest - 3;
        table += '</div>';
    }
    document.getElementById("cards-block").innerHTML = table;
}

function setCarousel(risposta) {
    html_command = '<div class="carousel-item active">'
        +'<img class="d-block w-100" src="/TicketStore/'+risposta[0].img+'" alt="First slide"></div>'
        +'<div class="carousel-item">'
        +'<img class="d-block w-100" src="/TicketStore/'+risposta[1].img+'" alt="Second slide"></div>'
        +'<div class="carousel-item">'
        +'<img class="d-block w-100" src="/TicketStore/'+risposta[2].img+'" alt="Third slide"></div>';
  
    document.getElementById("c-left").innerHTML = html_command ;    
}
