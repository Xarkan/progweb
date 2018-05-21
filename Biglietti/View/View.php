<?php

require 'libs/smarty-libs/Smarty.class.php';

class View extends Smarty {
    
    public function __construct() {
        parent::__construct();
        include 'Config.php';
        $this->setTemplateDir($config['smarty']['template_dir']);
        $this->setCompileDir($config['smarty']['compile_dir']);
        $this->setCacheDir($config['smarty']['cache_dir']);
        $this->setConfigDir($config['smarty']['config_dir']);
        
    }
    
    public function setTemplate( $template ) {
        $this->display( $template );
    }

    public function setDataIntoTemplate( $reference, $data  ) {
        $this->assign( $reference, $data );
    }

    public function getController()
    {
        if ( isset($_REQUEST['controller']))
            return $_REQUEST['controller'];
        else return false;
    }
    
    public function getTask(){
        if (isset($_REQUEST["task"]))
            return $_REQUEST["task"];
        else return false;        
    }
      
}
