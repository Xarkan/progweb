
function getAndFill() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var risposta = JSON.parse(xmlhttp.responseText);
        setTable(risposta);
        //document.getElementById("cards-block").innerHTML = xmlhttp.responseText;
    }
};
    xmlhttp.open("GET","index.php?controller=CHome&task=impostaHome", true);
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
            '<a href="Index.php?controller=CAcquistoBiglietto&task=DataLuogoPrezzo&id=' + k +'">' +
            '<img class="card-img-top" src="'+ risposta[k].path_img +'/'+ risposta[k].nome_img +'" alt="Card image cap"></a>' +
            '<div class="card-body"><p class="card-text">'+risposta[k].nome+'</p></div></div>';
            table += '<div class="col">' + html_command + '</div>';   
            k++; 
        }
        rest = rest - 3;
        table += '</div>';
    }
    document.getElementById("cards-block").innerHTML = table;
}

