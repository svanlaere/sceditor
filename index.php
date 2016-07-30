<?php
	
defined('IN_CMS') || exit();
	
//SCEditor version 1.3.2
Plugin::setInfos(array(
    'id'                    => 'sceditor',
    'title'                 => __('SCEditor'),
    'description'           => __('SCEditor Wysiwyg filter'),
    'version'               => '1.2.9',
    'license'               => 'MIT',
    'author'                => 'svanlaere',
    'website'               => 'http://svanlaere.nl/',
    'update_url'            => 'http://svanlaere.nl/plugin-versions.xml',
    'require_wolf_version'  => '0.7.5',
    'type'                  => 'both'
));

Observer::observe('view_backend_layout_head', 'sceditor_core_setup');
Filter::add('sceditor', 'sceditor/filter/Sceditor.php');
Plugin::addController('sceditor', 'SCEditor', '', false);

if (AuthUser::isLoggedIn()) {
    // Routes needed by the filter to fetch user setup/settings
    Dispatcher::addRoute(array(
        '/wolf/plugins/sceditor/scripts/init.js' => 'plugin/sceditor/sc_init',
    ));
}

// Add scripts for pages and snippets in edit view only
Observer::observe('dispatch_route_found','sceditor_core_setup');

function sceditor_core_setup($current_path) {
    $config_path = (USE_MOD_REWRITE) ? 'sceditor/' : '../../?/wolf/plugins/sceditor/';
    $controllers = '(page|snippet)';
    $actions = '(add|edit)';
    $pattern = '/^'.ADMIN_DIR.'\/'.$controllers.'\/'.$actions.'/';
	$user_language = i18n::getLocale();
	
    if (preg_match($pattern, $current_path)) {
        Plugin::addJavascript('sceditor', 'scripts/sceditor/jquery.sceditor.min.js');
		Plugin::addJavascript('sceditor', 'scripts/sceditor/languages/' . $user_language . '.js'  );
		
        echo new View(PLUGINS_ROOT . DS . 'sceditor/views/sceditor_init', array(
            'language' => $user_language,
        ));	   
    }
	
}
