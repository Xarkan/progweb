<?php


class EBiglietto {
    
    //attributes
    private $codice = ''; //string
    private $nomeEvento; //string
    private $data; //DateTime
    private $proprietario; //string
    private $zona; //string
    private $posto; //Posto

    
    //methods
    function __construct($nome, $data, $proprietario, $zona, $posto) {
        $this->nomeEvento = $nome;
        $this->data = $data;
        $this->proprietario = $proprietario;
        $this->zona = $zona;
        $this->posto = $posto;
    }
    
    function getCodice() {
        return $this->codice;
    }

    function setCodice($codice) {
        $this->codice = $codice;
    }




}
