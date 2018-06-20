function controllo_cookie() {
cookie = navigator.cookieEnabled;
if (cookie==false) alert('I cookie sono disabilitati. Per Un corretto uso dell applicazione, Abilitare i cookie');
}


function scriviCookie(nomeCookie,valoreCookie,durataCookie)
{
  var scadenza = new Date();
  var adesso = new Date();
  scadenza.setTime(adesso.getTime() + (parseInt(durataCookie) * 60000));
  document.cookie = nomeCookie + '=' + escape(valoreCookie) + '; expires=' + scadenza.toGMTString() + '; path=/';
}