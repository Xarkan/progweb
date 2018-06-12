
function getAndFill() {
    var url =  window.location.href;
    var splitted_url = url.split("/");
    var cod_e = splitted_url[splitted_url.length - 2];
    var cod_esp = splitted_url[splitted_url.length - 1];
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var risposta = JSON.parse(xmlhttp.responseText);
        setTable(risposta, cod_e, cod_esp);
    }
};
    xmlhttp.open("GET","/TicketStore/Json/"+cod_e+"/"+cod_esp, true);
    xmlhttp.send();
    
    var xmlhttp2 = new XMLHttpRequest();
    xmlhttp2.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var risposta2 = JSON.parse(xmlhttp2.responseText);
        setDettagli(risposta2);
    }
};    
    xmlhttp2.open("GET","/TicketStore/Json/"+cod_e, true);
    xmlhttp2.send();
}

function setTable(risposta, cod_e, cod_esp) {    
    var table = '';
 
    for(let i = 0; i < risposta.partecipazioni.length ; i++) {
        var html = '<form method="post" action="/TicketStore/ordine/'+cod_e+'/'+cod_esp+'/'+i+'"  class="form-signin">'+'<tr>'+
            '<td>'+
                '<div class="alert alert-secondary" role="alert">'+risposta.partecipazioni[i].zona.nome+'</div>'+
            '</td>'+
            '<td>'+
                '<div class="alert alert-secondary" role="alert">'+risposta.partecipazioni[i].prezzo+'</div>'+
            '</td>'+
            '<td>'+
                '<div class="input-group" id="num-bigl" name="num-bigl">'+
                    '<select class="custom-select" id="inputGroupSelect04" name="num_bigl">'+
                        '<option selected></option>'+
                        '<option value="1">1</option>'+
                        '<option value="2">2</option>'+
                        '<option value="3">3</option>'+
                        '<option value="4">4</option>'+
                    '</select>'+
                '</div>'+
            '</td>'+
            '<td>'+
                '<button class="btn btn-warning" type="submit">Carrello</button>'+
            '</td>'+
        '</tr>'+
        '</form>';
        table = table + html;      
    }
    
    document.getElementById("tr").innerHTML = table;
    
    /*var x = document.createElement("STYLE");
    var t = document.createTextNode("body {background: url("+risposta[cod_e].img+") no-repeat fixed center;}");
    //var t = document.createTextNode("body {background: url(View/imgs/Deep.jpg) no-repeat fixed center;}");
    x.appendChild(t);
    document.head.appendChild(x);*/
}

function setDettagli(risposta) {
    let nome = '<h1 class="display-4">'+risposta.nome+'</h1>';
    document.getElementById("nome-evento").innerHTML = nome;
    let html_command_immagine = '<img src=/TicketStore/'+risposta.img+' class="img-fluid" alt="Responsive image" id="side-img">';
    document.getElementById("immagine").innerHTML = html_command_immagine;
}


