<?php

use LAT\ClassLoader;

//Class loader
require_once 'vendors/LAT/ClassLoader.php';

//Register modules and libraries
$classLoader = new ClassLoader(array(
		'LAT' => 'vendors',
		'Plugins' => 'src',
		'Main\\Controllers' => 'src',
		'Main\\Entity' => 'src',
		'Proxies' => 'app/cache',
		'Doctrine' => 'vendors/Doctrine',
));

//Register
$classLoader->register();
