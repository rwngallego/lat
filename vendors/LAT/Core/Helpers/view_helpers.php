<?php

/**
 * render the view
 * @param string $path
 * @param mixed $args
 * @throws \InvalidArgumentException
 */
function render_view($path, $args = array()){
	list($module, $controller, $action) = explode(":", $path, 3);
	$fileName = "src/" . $module . "/Views/" . $controller . "/" . $action;
	
	if (!is_readable($fileName))
		throw new \InvalidArgumentException("The view $path does not exists or is not readable");
	
	foreach($args as $key => $value){
		$$key = $value;
	}
	
	include_once $fileName;
}

/**
 * echo the url of the route
 * @param string $route_id
 */
function path($route_id, $params = array()){
	$query_string = (count($params) > 0) ? "?": "";
	
	foreach($params as $key => $value){
		$key = urlencode($key);
		$value = urlencode($value);
		
		$query_string .= $key . '=' . $value;
	}	
	echo get_url($route_id) . $query_string;
}