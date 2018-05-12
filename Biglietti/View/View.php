<?php

require 'smarty-libs/Smarty.class.php';

class View extends Smarty {
    
    public function __construct() {
        parent::__construct();
        global $config;
    }
}
