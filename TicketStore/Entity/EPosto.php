<?php

class EPosto {

	private $fila;
	private $posto;

	public function __costruct($fila,$posto) {
		$this->fila = $fila;
		$this->posto = $posto;
	}

	public function getFila() {
		return $this->fila;
	}
	public function getPosto() {
		return $this->posto;
	}
	public function setFila($fila) {
		$this->fila = $fila;
	}
	public function setPosto($posto) {
		$this->posto = $posto;
	}
}