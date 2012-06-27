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

use Plugins\Auth;

/**
 * Plugin loader
 * 
 * @author Rowinson Gallego Medina <rwn.gallego@gmail.com>
 */
class PluginLoader {
	
	/**
	 * Path to the plugins directory
	 * 
	 * @var string
	 */
	private $dir;
	/**
	 * Namespace of the plugins
	 * 
	 * @var string
	 */
	private $ns;
	/**
	 * Store the methods in: array[index] = [$class_name, $method]
	 * 
	 * @var array
	 */
	private $registeredMethods;
	
	/**
	 * Constructor
	 * 
	 * @param string $pluginsDir        	
	 * @param string $namespace        	
	 */
	public function __construct($pluginsDir, $namespace) {
		if (! file_exists ( $pluginsDir ) || ! is_readable ( $pluginsDir ))
			throw new InvalidArgumentException ( "The dir $pluginsDir does not exists or is not readable" );
		if (! is_string ( $namespace ))
			throw new InvalidArgumentException ( "The namespace $namepace must be a string" );
		$this->dir = $pluginsDir;
		$this->ns = ( string ) $namespace;
	}
	
	/**
	 * Register plugins
	 */
	public function registerPlugins() {
		$classes = $this->getClasses ();
		$this->registerKnownMethods ( $classes );
	}
	
	/**
	 * Execute the action of the registered plugins
	 * 
	 * @param string $action        	
	 */
	public function runAction($action) {
		$registers = array ();
		if (isset ( $this->registeredMethods [$action] ))
			$registers = $this->registeredMethods [$action];
		else
			throw new \BadMethodCallException ( "The action $action does not exists in the plugin loader" );
		foreach ( $registers as $register ) {
			if (is_callable ( $register ))
				call_user_func ( $register );
		}
	}
	
	/**
	 * Get the classes from the $this->dir
	 * 
	 * @return mixed multitype: of classes
	 */
	private function getClasses() {
		$files = scandir ( $this->dir );
		
		// removes the [0] = '.' and [1] = '..'
		$files = array_slice ( $files, 2 );
		
		$classes = array ();
		foreach ( $files as $file ) {
			$className = str_replace ( ".php", "", $file );
			$fullClassName = $this->ns . "\\" . $className;
			if (class_exists ( $fullClassName )) {
				$classes [] = $fullClassName;
			}
		}
		return $classes;
	}
	
	/**
	 * Register the known methods of the given classes
	 * 
	 * @param unknown_type $classes        	
	 */
	private function registerKnownMethods($classes) {
		$knownMethods = array ();
		foreach ( $classes as $class ) {
			$methods = get_class_methods ( $class );
			foreach ( $methods as $method ) {
				$this->registerKnownMethod ( $class, $method );
			}
		}
	}
	
	/**
	 * Register the method into $this->registeredMethods if it is known
	 * 
	 * @param string $class        	
	 * @param string $method        	
	 */
	private function registerKnownMethod($class, $method) {
		switch ($method) {
			case "beforeRouterDispatch" :
				$this->registeredMethods ["beforeRouterDispatch"] [] = array (
						$class,
						$method 
				);
				break;
			case "afterRouterDispatch" :
				$this->registeredMethods ["afterRouterDispatch"] [] = array (
						$class,
						$method 
				);
				break;
			default :
				throw new \BadMethodCallException ( "The method $method registered in the class $class is not known. Did you mean it not to be public but private?" );
				break;
		}
	}
}