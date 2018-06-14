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
            $k = 1;
            $fila = 1;
            while($k < $capacità) {
                for ($i = 0; $i < 5; $i++) {
                    $posto = new EPosto($fila,$i);
                    $this->posti[] = $posto;
                    $k++;
                }
                $fila++;
            }
        }
        public function assegnaPosti($num) {
            for ($i = 1; $i <= $num; $i++) {
                $posti[$i-1] = $this->posti[count($this->posti) - $i];
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