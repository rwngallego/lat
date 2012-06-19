<?php

namespace L8T\Core;

/**
 * Router
 * @author rowinson
 */
class Router{

	private $routes;

	/**
	 * Construct and initialize the object.
	 * @param string $file
	 */
	public function __construct($file){
		$this->routes = new \SimpleXMLElement($file, NULL, true);
		
		//TODO: Move this function from helpers to a static method in this class
		$base_uri = \get_base_url();
		$requested_uri = $this->getRequestedUri($base_uri);
		$GLOBALS['resource'] = $this->getResourceFromUri($requested_uri);
	}

	/**
	 * Get the requested uri
	 * @param string $base_uri
	 * @return string
	 */
	public function getRequestedUri($base_uri){
		return str_replace($base_uri, "", $_SERVER['REQUEST_URI']);
	}

	/**
	 * Get the resource from the uri
	 * @param string $uri
	 * @throws \Exception
	 * @return string or NULL if the resource was not found
	 */
	public function getResourceFromUri($uri){
		$found = false;
		$resource = null;

		foreach($this->routes as $route){
			if ($route->uri == $uri){

				//get the resource
				$resource = $route->res;
				$found = true;
			}
		}
		if ($found == false)
			throw new \Exception("The resource of the route $uri was not found");

		return $resource;
	}

	/**
	 * Dispatch the resource registered in $GLOBALS['resource']
	 * @throws \Exception
	 */
	public function dispatch(){
		//get the resource
		$resource = $GLOBALS['resource'];

		list($module, $controller, $action) = explode(':', $resource, 3);

		$class = ucfirst($module) . "\\Controllers\\" . ucfirst($controller) . "Controller";
		$method = "{$action}Action";

		//create the entity
		$instance = new $class;

		//call the method
		$instance->$method();

		$found = true;

	}
}

