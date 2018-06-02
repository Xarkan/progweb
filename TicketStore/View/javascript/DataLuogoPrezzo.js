
function fillLuogoData() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var risposta = JSON.parse(xmlhttp.responseText);
        setTable(risposta);
        //document.getElementById("cards-block").innerHTML = xmlhttp.responseText;
    }
};
    xmlhttp.open("GET","index.php?controller=CAcquistoBiglietto&task=impostaDLP", true);
    xmlhttp.send();
}

function setTable(risposta) {
    
}