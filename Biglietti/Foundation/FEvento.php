<?php

class FEvento {
    
    //attributes          
    private $_connection;
    private $_connected;
    
    //methods
    public function __construct() {
        
        global $config;
        $this->connect( $config['mysql']['host'],
                        $config['mysql']['user'],
                        $config['mysql']['password'],        
                        $config['mysql']['database']);
    }
    
    public function connect($host, $user, $password, $database) {
        $this->_connection = new mysqli($host,$user,$password,$database);
        if ($this->_connection->connect_errno) {
            $this->_connected = false;
        }
        else {
            $this->_connected = true;            
        }
    }
    
    public function getError() {
        return $this->_connected;
    }
    
    public function exist(EEvento $evento) {
        if ($this->_connection->connect_errno) {
            $this->_connected = false;
        }
        else {
            $result = $this->_connection->query("SELECT * FROM evento WHERE codev=".$evento->getCodev());
            return $result;
        }
    }    
    
    public function load() {
        
    }
    
    public function store() {
        
    }
    
    public function update() {
        
    }
    
    public function delete() {
        
    }

}
