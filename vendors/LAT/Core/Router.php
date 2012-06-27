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

/**
 * Router
 *
 * @author Rowinson Gallego Medina <rwn.gallego@gmail.com>
 */
class Router {
	private $routes;
	
	/**
	 * Construct and initialize the object.
	 *
	 * @param string $file        	
	 */
	public function __construct($file) {
		$this->routes = new \SimpleXMLElement ( $file, NULL, true );
		
		// TODO: Move this function from helpers to a static method in this
		// class
		$base_uri = \get_base_url ();
		$requested_uri = $this->getRequestedUri ( $base_uri );
		$GLOBALS ['resource'] = $this->getResourceFromUri ( $requested_uri );
	}
	
	/**
	 * Get the requested uri
	 *
	 * @param string $base_uri        	
	 * @return string
	 */
	public function getRequestedUri($base_uri) {
		$request_uri = str_replace ( $base_uri, "", $_SERVER ['REQUEST_URI'] );
		$pos = stripos ( $request_uri, $_SERVER ['QUERY_STRING'] );
		if ($pos != 0)
			$pos --; // strip the "?"
		else
			$pos = strlen ( $request_uri );
		return substr ( $request_uri, 0, $pos );
	}
	
	/**
	 * Get the resource from the uri
	 *
	 * @param string $uri        	
	 * @throws \Exception
	 * @return string or NULL if the resource was not found
	 */
	public function getResourceFromUri($uri) {
		$found = false;
		$resource = null;
		
		foreach ( $this->routes as $route ) {
			if ($route->uri == $uri) {
				
				// get the resource
				$resource = $route->res;
				$found = true;
			}
		}
		if ($found == false)
			throw new \Exception ( "The resource of the route $uri was not found" );
		
		return $resource;
	}
	
	/**
	 * Dispatch the resource registered in $GLOBALS['resource']
	 *
	 * @throws \Exception
	 */
	public function dispatch() {
		// get the resource
		$resource = $GLOBALS ['resource'];
		
		list ( $module, $controller, $action ) = explode ( ':', $resource, 3 );
		
		$class = $module . "\\Controllers\\" . $controller . "Controller";
		$method = "{$action}Action";
		
		if (! class_exists ( $class ))
			throw new \InvalidArgumentException ( "The class $class does not exist" );
			
			// create the entity
		$instance = new $class ();
		
		if (! method_exists ( $instance, $method ))
			throw new \BadMethodCallException ( "The method $method in class $class does not exist" );
			
			// call the method
		$instance->$method ();
		
		$found = true;
	}
}

