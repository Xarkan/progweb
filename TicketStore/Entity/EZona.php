<?php

class EZona {

	//attributi
	public $nome;
	public $capacità;
	public $posti = []; //array(Posto) da capire se ci si mettono solo quelli presi...

	//metodi
        public function __construct($nome,$capacità) {
            $this->nome = $nome;
            $this->capacità = $capacità;
            /*for ($i = 0; $i < $capacità; $i++) {
                $posto = new EPosto(0,$i);
                $this->posti[] = $posto;
            }*/
        }
        public function assegnaPosto() {
            $posto = array_pop($this->posti);
            return $posto;
        }
        
        public function getPostiDisp() {
            $postiDisp = count($this->posti);
            return $postiDisp;
        }
}