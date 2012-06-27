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
namespace LAT;

/**
 * ClassLoader implementation.
 * Autoload classes using the SPL autoloader
 *
 * @author Rowinson Gallego Medina <rwn.gallego@gmail.com>
 *        
 */
class ClassLoader {
	private $fileExtension = '.php';
	private $namespaces;
	
	/**
	 * Creates a new classloader
	 *
	 * @param string $namespaces        	
	 */
	public function __construct($namespaces) {
		$this->namespaces = $namespaces;
	}
	public function register() {
		spl_autoload_register ( array (
				$this,
				'loadClass' 
		) );
	}
	public function loadClass($className) {
		foreach ( $this->namespaces as $ns => $path ) {
			$fileToLoad = $path . '/' . str_replace ( '\\', DIRECTORY_SEPARATOR, $className ) . $this->fileExtension;
			if ($ns !== null && strpos ( $className, $ns . '\\' ) !== 0)
				continue;
			else {
				if (file_exists ( $fileToLoad ) == true) {
					require ($fileToLoad);
					return true;
				}
				continue;
			}
		}
	}
}

?>
