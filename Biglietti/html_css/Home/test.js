
function getAndFill() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var risposta = JSON.parse(this.responseText);
        setTable(risposta);
    }
};
    xmlhttp.open("GET","Index.php?controller=CHome&task=impostaHome", true);
    xmlhttp.send();
}

function setTable(risposta) {
    var table = '';
    var rows = risposta.length;
    var cols = risposta.length;
    var rest = 0;
    var k = 0;
    for(let r = 0; r < risposta.length - rest; r++) {
        table += '<div class="row">';
        for (let c = 0; c < cols && c < 3; c++) {
            let html_command = '<div class="card" style="width: 18rem;">' +
            '<a href="Index.php?controller=CAcquistoBiglietto&task=DataLuogoPrezzo&id=evento' + risposta[k][cod_evento] +'">' +
            '<img class="card-img-top" src="#" alt="Card image cap"></a>' +
            '<div class="card-body"><p class="card-text">...</p></div></div>';
            table += '<div class="col">' + html_command + '</div>';   
            k++; 
        }
        rest = risposta.length - 3;
        table += '</div>';
    }
    document.getElementById("cards-block").innerHTML = table;
}
