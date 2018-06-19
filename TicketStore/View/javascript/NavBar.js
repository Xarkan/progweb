

function isLogged() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var risposta = JSON.parse(xmlhttp.responseText);
        setNav(risposta);
    }
};
    xmlhttp.open("GET","/TicketStore/Json/logged", true);
    xmlhttp.send();
}

function setNav(risposta) {
    let html;
    if(!risposta) {
        html = '<a class="nav-link" href="/TicketStore/login">Accedi</a>';        
    }else{
        html = '<a class="nav-link" href="/TicketStore/logout">Logout</a>';
    }
    document.getElementById("user").innerHTML = html;
    document.getElementById("home-link").setAttribute("href","/TicketStore/home");
}