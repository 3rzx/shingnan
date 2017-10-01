<?php

require_once SMARTY_DIR . 'Smarty.class.php';

// smarty configuration
class SmartyConfig extends Smarty
{
    public function __construct()
    {
        parent::__construct();

        $this->setTemplateDir(HOME_DIR . 'view/');
        $this->setCompileDir(HOME_DIR . 'view/compile/');
        $this->setConfigDir(HOME_DIR . 'configs/');
        $this->setCacheDir(HOME_DIR . 'cache/');

        $this->left_delimiter  = '\{';
        $this->right_delimiter = '\}';
        $this->compile_check   = true;
        $this->force_compile   = true;

        //$this->debugging = true;
    }
}
