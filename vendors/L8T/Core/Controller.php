<?php

namespace L8T\Core;

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
	 * get the doctrine entity manager
	 * @return \Doctrine\ORM\EntityManager
	 */
	final public function getEntityManager(){
		$doctrineLoader = DoctrineLoader::getInstance();
		return $doctrineLoader->getEntityManager();
	}
	
}