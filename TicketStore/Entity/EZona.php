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
        public function assegnaPosti($num) {
            for ($i = 1; $i <= $num; $i++) {
                $posti[$i] = $this->posti[count($this->posti) - $i];
            }
            
            return $posti;
        }
        
        public function getPostiDisp() {
            $postiDisp = count($this->posti);
            return $postiDisp;
        }
        
        public function confermaPosto() {
            $posto = array_pop($this->posti);
            //roba di database
        }
}