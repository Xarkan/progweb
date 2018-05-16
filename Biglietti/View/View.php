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
        var_dump($config);
    }
    
    public function setTemplate( $template ) {
        $this->display( $template );
    }

    public function setDataIntoTemplate( $reference, $data  ) {
        $this->assign( $reference, $data );
    }  
}
