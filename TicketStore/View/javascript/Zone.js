
function getAndFill() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var risposta = JSON.parse(xmlhttp.responseText);
        setTable(risposta);
    }
};
    xmlhttp.open("GET","/TicketStore/home", true);
    xmlhttp.send();
}

function setTable(risposta) {    
    var table = '';
    var url =  window.location.href;
    var splitted_url = url.split("/");
    var cod_e = splitted_url[splitted_url.length - 2];
    var cod_esp = splitted_url[splitted_url.length - 1];
    
    for(let i = 0; i < risposta[cod_e].eventi[cod_esp].partecipazioni.length ; i++) {
        var html = '<form method="post" action="/TicketStore/ordine/'+cod_e+'/'+cod_esp+'/'+i+'"  class="form-signin">'+'<tr>'+
            '<td>'+
                '<div class="alert alert-secondary" role="alert">'+risposta[cod_e].eventi[cod_esp].partecipazioni[i].zona+'</div>'+
            '</td>'+
            '<td>'+
                '<div class="alert alert-secondary" role="alert">'+risposta[cod_e].eventi[cod_esp].partecipazioni[i].prezzo+'</div>'+
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
    let nome = '<h1 class="display-4">'+risposta[cod_e].nome+'</h1>';
    document.getElementById("nome-evento").innerHTML = nome;
    let html_command_immagine = '<img src=/TicketStore/'+risposta[cod_e].img+' class="img-fluid" alt="Responsive image" id="side-img">';
    document.getElementById("immagine").innerHTML = html_command_immagine;
    document.getElementById("tr").innerHTML = table;
    
    /*var x = document.createElement("STYLE");
    var t = document.createTextNode("body {background: url("+risposta[cod_e].img+") no-repeat fixed center;}");
    //var t = document.createTextNode("body {background: url(View/imgs/Deep.jpg) no-repeat fixed center;}");
    x.appendChild(t);
    document.head.appendChild(x);*/
}


