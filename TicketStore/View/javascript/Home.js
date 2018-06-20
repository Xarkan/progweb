
function getAndFill() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var risposta = JSON.parse(xmlhttp.responseText);
        setTable(risposta);
        setCarousel(risposta);
    }
};
    xmlhttp.open("GET","/TicketStore/Json/home", true);
    xmlhttp.send();
}


function setTable(risposta) {
    var table = '';
    var rest = risposta.length;
    var k = 0;
    while(rest > 0) {
        table += '<div class="row">';
        for (let c = 0; c < 9 && c < rest; c++) {
            let html_command = '<div class="card">' +
            '<a href="/TicketStore/evento/'+ risposta[k].id +'">' +
            '<img class="card-img-top" src="/TicketStore/'+ risposta[k].img+'" alt="Card image cap"></a>' +
            '<div class="card-body"><p class="card-text">'+risposta[k].nome+'</p></div></div>';
            table += '<div class="col">' + html_command + '</div>';   
            k++; 
        }
        rest = rest - 9;
        table += '</div>';
    }
    document.getElementById("cards-block").innerHTML = table;
}

function setCarousel(risposta) {
    let html_command = '<div class="carousel-item active" id="carousel-imgs">'
        +'<img class="d-block w-100" src="/TicketStore/'+risposta[0].img+'" alt="First slide"></div>'
        +'<div class="carousel-item">'
        +'<img class="d-block w-100" src="/TicketStore/'+risposta[1].img+'" alt="Second slide"></div>'
        +'<div class="carousel-item">'
        +'<img class="d-block w-100" src="/TicketStore/'+risposta[2].img+'" alt="Third slide"></div>'
        +'<div class="carousel-item">'
        +'<img class="d-block w-100" src="/TicketStore/'+risposta[3].img+'" alt="Third slide"></div>'
        +'<div class="carousel-item">'
        +'<img class="d-block w-100" src="/TicketStore/'+risposta[4].img+'" alt="Third slide"></div>'
        +'<div class="carousel-item">'
        +'<img class="d-block w-100" src="/TicketStore/'+risposta[5].img+'" alt="Third slide"></div>';

    document.getElementById("c-left").innerHTML = html_command ;    
}
