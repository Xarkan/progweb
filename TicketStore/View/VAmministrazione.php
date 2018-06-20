<?php

class VAmministrazione {
    
    public function print_json($ultimo_cod) {
        $json = json_encode($ultimo_cod);
        echo $json;
    }
    
    public function set_html() {
        //header('Location: /TicketStore/amministratore');
    echo '<html>';
    echo '<head>';
    echo '<title>Amministrazione</title>';
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        
    echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">';
    echo '<link rel="stylesheet" type="text/css" href="/TicketStore/View/css/amministrazione.css">';
    echo '</head>';
    echo '<body>';
    
    echo '<div class="jumbotron jumbotron-fluid" id="header">';
    echo '<div class="container">';
    echo '<h1 class="display-4"><a href="/TicketStore/logout" id="home-link">TicketStore</a></h1>';
    echo '</div>';
    echo '</div>';
    echo '    <div>';
    echo '        <form method="post" action="Amministrazione">';
    echo '            <fieldset>';
    echo '                <legend>Possibili Operazioni</legend>   ';
    echo '                  <table>';
    echo '                    <tr> ';
    echo '                      <td> Operazione</td>';
    echo '                      <td> <select name="Operazione" id="operazione" onchange="setTableEvento()">';
                                   
    echo '                                 <option></option>';
    echo '                                 <option>inserimento</option>';
    echo '                                 <option>modifica</option>';
    echo '                                 <option>cancellazione</option>';
                                     
    echo '                           </select>';
    echo '                       </td>';
    echo '                    </tr> ';
    echo '                  </table>';
    echo '            </fieldset>   ';
    echo '            <fieldset>';
    echo '                <legend>Tabella</legend>';  
    echo '                  <table>';
    echo '                    <tr> ';
    echo '                      <td>Tabella su cui agire</td>';
    echo '                      <td> <select name="Tabella" id="table" onchange="setTableEvento()">';
                                                                    
    echo '                              <option></option>';
    echo '                              <option>evento</option>';
    echo '                              <option>utente_r</option>';
    echo '                              <option>evento_spec</option>';
    echo '                              <option>partecipazione</option>';
    echo '                              <option>zona</option>';
    echo '                              <option>biglietti</option>';
                                  
    echo '                          </select>';
    echo '                      </td>';
    echo '                    </tr> ';
    echo '                 </table>';
    echo '            </fieldset>';
    echo '            <fieldset id="sezione">';
                    
    echo '            </fieldset>';
                
    echo '            <button type="submit" id="btn">Procedi</button>';
    echo '        </form>';
    echo '    </div>';
    echo '    <script src="/TicketStore/View/javascript/Amministrazione.js"></script>';
    echo '</body>';
    echo '</html>';
    }
}
