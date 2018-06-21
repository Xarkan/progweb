
function getAndFill() {
    var url =  window.location.href;
    var splitted_url = url.split("/");
    var cod_e = splitted_url[splitted_url.length - 2];
    var splitted_data = splitted_url[splitted_url.length - 1].split(" ");
    var cod_esp = splitted_data[0] +"_"+ splitted_data[1];
    
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
    var selection = '';
    var button = '';
    var stato = '';
    for(let i = 0; i < risposta.partecipazioni.length ; i++) {
        if(risposta.partecipazioni[i].disp) { 
            for(let j = 1; j <= risposta.partecipazioni[i].numPosti && j <= 4; j++) {
                selection = selection + '<option value="'+j+'">'+j+'</option>';
                button = '<button class="btn btn-warning" type="submit">Carrello</button>';
            }
        }else{
            button = '<button type="button" class="btn btn-secondary btn-lg" disabled>Carrello</button>';
            stato = 'terminati';
        }
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
                        '<option selected>'+stato+'</option>'+ selection +
                    '</select>'+
                '</div>'+
            '</td>'+
            '<td>'+
            button +
            '</td>'+
        '</tr>'+
        '</form>';
        table = table + html;      
    }
    
    document.getElementById("tr").innerHTML = table;
    
}

function setDettagli(risposta) {
    let nome = '<h1 class="display-4">'+risposta.nome+'</h1>';
    document.getElementById("nome-evento").innerHTML = nome;
    let html_command_immagine = '<img src=/TicketStore/'+risposta.img+' class="img-fluid" alt="Responsive image" id="side-img">';
    document.getElementById("immagine").innerHTML = html_command_immagine;
}


