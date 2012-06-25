<?php

use LAT\Core\FrontController;

define('APPLICATION_ENV', getenv("APPLICATION_ENV"));

//Loader
require_once('app/autoloader.php');

//Bootstrap
$fc = new FrontController();
$fc->start();


?>
