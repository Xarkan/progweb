

function comunicazioni(){
    
    url_prec = document.referrer;
    //window.history.forward();
    
    
    
    //approccio sbagliato non si devono usare le url
    if(url_prec == 'http://localhost/TicketStore/signin'){
        window.alert('La Mail che hai inserito è stata già usata per la registrazione. Procedi al login');
    }
    //esaminare caso per caso
    
}

 


