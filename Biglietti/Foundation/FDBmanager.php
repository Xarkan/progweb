<?php

class FDBmanager {
    
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
    
    public function exist($object) {
        switch (get_class($object)) {
            case 'EEvento':
                
                
                
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

