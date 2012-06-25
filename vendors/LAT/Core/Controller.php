<?php

namespace LAT\Core;

/**
 * Base class for controllers
 * @author rowinson
 *
 */
class Controller{
	
	/**
	 * Render the view
	 * @param string $path
	 * @param mixed $args
	 * @throws \InvalidArgumentException
	 */
	final public function renderView($path, $args = array()){
		render_view($path, $args);
	}
	
	/**
	 * Get the doctrine entity manager
	 * @return \Doctrine\ORM\EntityManager
	 */
	final public function getEntityManager(){
		$doctrineLoader = DoctrineLoader::getInstance();
		return $doctrineLoader->getEntityManager();
	}
	
	/**
	 * Redirect to the given url
	 * @param string $url Must contain "http://" if it is absolute
	 */
	final public function redirect($url){
		if (stripos($url, "http://")===false){
			$host = $_SERVER['HTTP_HOST'];
			$uri = rtrim($url, '/\\');
			$url = "http://" . $host . $uri;
		}
		header('Location: ' . $url);
		exit();
	}
	
}