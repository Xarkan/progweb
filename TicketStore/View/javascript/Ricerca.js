function getAndFill() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var risposta = JSON.parse(xmlhttp.responseText);
        setTable(risposta);
        
    }
};
    xmlhttp.open("GET","/TicketStore/Json/ricerca", true);
    xmlhttp.send();
}


function setTable(risposta) {
    
    var table = '';
    
    for(let i = 0; i < risposta.length ; i++) {
        
        for(let j = 0; j < risposta[i].eventi.length; j++){
            var splitted_data = risposta[i].eventi[j].data.split(" ");
            var data = splitted_data[0] +"_"+ splitted_data[1];
            let html_command = '<tr><td>'+risposta[i].eventi[j].data+'</td>'+
                '<td>'+risposta[i].nome+'</td>'+   
                '<td>'+risposta[i].eventi[j].luogo.citta+'</td>'+
                '<td>'+risposta[i].eventi[j].luogo.struttura+'</td>'+
                '<td>'+risposta[i].eventi[j].partecipazioni[0].prezzo+'</td>'+
                '<td><a type="button" class="btn btn-warning" href="/TicketStore/zone/'+risposta[i].id+'/'+data+'">Acquista</a></td></tr>';
            table = table + html_command;
        }
            
    }
    document.getElementById("table").innerHTML = table;
    

}   
