

function returnToRequestPage(){
    
    url_prec = document.referrer;
   //window.history.forward();
    
    
    if(url_prec == 'http://localhost/TicketStore/signin.html'){
        window.alert('La Mail che hai inserito è stata già usata per la registrazione. Procedi al login');
    }
    //esaminare caso per caso
    
}

 


