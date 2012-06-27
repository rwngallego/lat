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
 * Base class for controllers
 *
 * @author Rowinson Gallego Medina <rwn.gallego@gmail.com>
 *        
 */
class Controller {
	
	/**
	 * Render the view
	 *
	 * @param string $path        	
	 * @param mixed $args        	
	 * @throws \InvalidArgumentException
	 */
	final public function renderView($path, $args = array()) {
		render_view ( $path, $args );
	}
	
	/**
	 * Get the doctrine entity manager
	 *
	 * @return \Doctrine\ORM\EntityManager
	 */
	final public function getEntityManager() {
		$doctrineLoader = DoctrineLoader::getInstance ();
		return $doctrineLoader->getEntityManager ();
	}
	
	/**
	 * Redirect to the given url
	 *
	 * @param string $url
	 *        	Must contain "http://" if it is absolute
	 */
	final public function redirect($url) {
		if (stripos ( $url, "http://" ) === false) {
			$host = $_SERVER ['HTTP_HOST'];
			$uri = rtrim ( $url, '/\\' );
			$url = "http://" . $host . $uri;
		}
		header ( 'Location: ' . $url );
		exit ();
	}
}