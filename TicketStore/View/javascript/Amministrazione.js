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
