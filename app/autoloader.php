<?php

/**
 * LAT Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * 
 * If you did not receive a copy of the license please send an email
 * to rwn.gallego@gmail.com so we can send you a copy immediately.
 *
 * @category LAT
 * @package App
 * @copyright Copyright (c) 2012 Rowinson Gallego Medina
 * @license New BSD License
 */

use LAT\ClassLoader;

// Class loader
require_once 'vendors/LAT/ClassLoader.php';

// Register modules and libraries
$classLoader = new ClassLoader ( array (
		'LAT' => 'vendors',
		'Plugins' => 'src',
		'Main\\Controllers' => 'src',
		'Main\\Entity' => 'src',
		'Proxies' => 'app/cache',
		'Doctrine' => 'vendors/Doctrine' 
) );

// Register
$classLoader->register ();
