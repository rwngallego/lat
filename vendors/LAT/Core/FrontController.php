<?php

/**
 * LAT Framework
 *
 * This file is part of the LAT framework.
 *
 * (c) Rowinson Gallego Medina <rwn.gallego@gmail.com>
 *
 * This source file is subject to the New BSD license that is bundled
 * with this source code in the file LICENSE.txt
 *
 * @category LAT
 * @package Core
 * @license New BSD License
 */
namespace LAT\Core;

use LAT\Core\DoctrineLoader;
use LAT\Core\PluginLoader;
use LAT\Core\Router;

/**
 * Front controller
 *
 * @author Rowinson Gallego Medina <rwn.gallego@gmail.com>
 *        
 */
class FrontController {
	
	/**
	 * plugin loader
	 *
	 * @var PluginLoader
	 */
	private $pluginLoader;
	
	/**
	 * Starts the framework components
	 */
	public function start() {
		$this->pluginLoader = new PluginLoader ( "src/Plugins", "Plugins" );
		$this->pluginLoader->registerPlugins ();
		
		// TODO: Generalize this... Helpers load
		include_once (__DIR__ . "/Helpers/route_helpers.php");
		include_once (__DIR__ . "/Helpers/view_helpers.php");
		
		$dbParams = parse_ini_file ( "app/config/parameters.ini", true );
		$doctrineLoader = DoctrineLoader::getInstance ();
		$doctrineLoader->init ( $dbParams ['db'] );
		
		// TODO: Define the specific routes on top (index.php)
		$router = new Router ( 'app/config/routes.xml' );
		
		$this->pluginLoader->runAction ( "beforeRouterDispatch" );
		
		$router->dispatch ();
		
		$this->pluginLoader->runAction ( "afterRouterDispatch" );
	}
}
