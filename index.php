<?php
	
defined('IN_CMS') || exit();
	
//SCEditor version 1.3.2
Plugin::setInfos(array(
    'id'                    => 'sceditor',
    'title'                 => __('SCEditor'),
    'description'           => __('SCEditor Wysiwyg filter'),
    'version'               => '1.2.9',
    'license'               => 'GPLv3',
    'author'                => 'Fortron',
    'require_wolf_version'  => '0.7.5',
	'type'                  => 'both'
));

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

function sceditor_core_setup() {
    $config_path = (USE_MOD_REWRITE) ? 'sceditor/' : '../../?/wolf/plugins/sceditor/';
    $controllers = '(page|snippet)';
    $actions = '(add|edit)';
    $pattern = '/^'.ADMIN_DIR.'\/'.$controllers.'\/'.$actions.'/';
	$user_language = i18n::getLocale();
	
	
    if (preg_match($pattern, CURRENT_URI)) {
        Plugin::addJavascript('sceditor', 'scripts/sceditor/jquery.sceditor.min.js');
        /* nasty way of including scripts */
        Plugin::$javascripts[] = $config_path.'scripts/init.js';
        Plugin::addJavascript('sceditor', 'scripts/sceditor/languages/' . $user_language . '.js'  );
    }
	
}
