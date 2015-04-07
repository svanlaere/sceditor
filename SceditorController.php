<?php
defined('IN_CMS') || exit();


class SCEditorController extends PluginController
{
    public function __construct()
    {
        // Check if logged in
        parent::__construct();
        if (defined('CMS_BACKEND')) {
            $this->setLayout('backend');
        } else {
            $this->setLayout(null);
        }
    }
        
    // Outputs init.js
    public function sc_init()
    {
		$user_language = i18n::getLocale();
        $language      = isset($user_language) ? $user_language : 'en';
        header("Content-type: application/x-javascript; charset=utf8");
        
        $this->display('sceditor_init', array(
            'language' => $language
        ));
    }
	  
    // render method will use our views path ( backend or frontend )
    public function render($view, $vars = array())
    {
        $views_path = PLUGINS_ROOT . DS . 'sceditor' . DS . 'views';
        $views_path .= DS;
        return parent::render($views_path . DS . $view, $vars);
    }
    
    public function display($view, $vars = array(), $exit = true)
    {
        echo $this->render($view, $vars);
        if ($exit)
            exit;
    }
    
} // end class