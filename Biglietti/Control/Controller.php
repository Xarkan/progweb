<?php

class Controller{
	
protected $view;	
private $controller;
private $task;

//metodi

public function __construct(){
	$this->view=USingleton::getInstance('View');
	$this->controller=$this->view->getController();
	$this->task=$this->view->getTask();
	
}

public function esegui(){
	if($this->controller){
	$istanzacontroller=USingleton::getInstance("$this->controller");
	
	$istruzione="$this->task";
	$istanzacontroller->$istruzione();
	}else{
	$chome=Usingleton::getInstance('CHome');
	$chome->impostaPagina();}	
}

}