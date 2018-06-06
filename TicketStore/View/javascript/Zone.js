
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
    var url =  window.location.href;
    var splitted_url = url.split("/");
    var codice = splitted_url[splitted_url.length - 1];
}


