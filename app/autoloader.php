<?php

use L8T\ClassLoader;

//Class loader
require_once 'vendors/L8T/ClassLoader.php';

//Register modules and libraries
$classLoader = new ClassLoader(array(
		'L8T' => 'vendors',
		'Plugins' => 'src',
		'Main\\Controllers' => 'src',
		'Main\\Entity' => 'src',
		'Proxies' => 'app/cache',
		'Doctrine' => 'vendors/Doctrine',
));

//Register
$classLoader->register();
