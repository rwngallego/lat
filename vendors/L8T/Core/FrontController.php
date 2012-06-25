<?php

namespace L8T\Core;

use L8T\Core\DoctrineLoader;
use L8T\Core\PluginLoader;
use L8T\Core\Router;


/**
 * Front controller
 * @author rowinson
 *
 */
class FrontController{

	/**
	 * plugin loader
	 * @var PluginLoader
	 */
	private $pluginLoader;

	/**
	 * Starts the framework components
	 */
	public function start(){
		$this->pluginLoader = new PluginLoader("src/Plugins", "Plugins");
		$this->pluginLoader->registerPlugins();
		
		//TODO: Generalize this... Helpers load
		include_once(__DIR__ . "/Helpers/route_helpers.php");
		include_once(__DIR__ . "/Helpers/view_helpers.php");
		
		$dbParams = parse_ini_file("app/config/parameters.ini", true);
		$doctrineLoader = DoctrineLoader::getInstance();
		$doctrineLoader->init($dbParams['db']);
		
		//TODO: Define the specific routes on top (index.php)
		$router = new Router('app/config/routes.xml');

		$this->pluginLoader->runAction("beforeRouterDispatch");

		$router->dispatch();
		
		$this->pluginLoader->runAction("afterRouterDispatch");
		
	}
}
