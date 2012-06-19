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