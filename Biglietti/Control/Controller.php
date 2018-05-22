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
	$istanzacontroller=USingleton::getInstance("$this->controller");//mi ritorna un'istanza di controller
	
	$istruzione="$this->task";//viene settato il metodo da richiamare
	$istanzacontroller->$istruzione();//richiama il metodo $istruzione = $this->task
	}else{
	$chome=Usingleton::getInstance('CHome');
	$chome->impostaPagina();}	
}

}