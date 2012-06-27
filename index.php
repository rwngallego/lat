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
* @package Index
* @copyright Copyright (c) 2012 Rowinson Gallego Medina
* @license New BSD License
*/

use LAT\Core\FrontController;

define ( 'APPLICATION_ENV', getenv ( "APPLICATION_ENV" ) );

// Loader
require_once ('app/autoloader.php');

// Bootstrap
$fc = new FrontController ();
$fc->start ();

?>
