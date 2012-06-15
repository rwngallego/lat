<?php

use L8T\ClassLoader;

//Class loader
require_once 'vendors/L8T/ClassLoader.php';

//Register modules and libraries
$classLoader = new ClassLoader(array(
	'L8T' => 'vendors',
	'Nomicent\\Controllers' => 'src',
	'Main\\Controllers' => 'src',
));

//Register
$classLoader->register();


