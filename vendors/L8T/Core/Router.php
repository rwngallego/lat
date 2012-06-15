<?php

namespace L8T\Core;

class Router{
	
	private $requested_uri;
	private $routes;

	public function __construct(){
		isset($_SERVER['PATH_INFO']) ? $this->requested_uri = $_SERVER['PATH_INFO']: $this->requested_uri = "/";
	}
	
	public function set_routes($file){
		$this->routes = new \SimpleXMLElement($file, NULL, true);
	}
	
	public function fetch(){
		$found = false;
		foreach($this->routes as $route){
			if ($route->uri == $this->requested_uri){
				
				//get the resource
				list($module, $controller, $action) = explode(':', $route->res);
				
				$class = ucfirst($module) . "\\Controllers\\" . ucfirst($controller) . "Controller";
				$method = "{$action}Action";
				
				//create the entity
				$instance = new $class;
				
				//call the method
				$instance->$method();
				
				$found = true;
			}
		}
		if ($found == false)
			throw new \Exception("The route $this->requested_uri was not found");
	}
}

