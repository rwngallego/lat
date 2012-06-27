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
 * @subpackage Helpers
 * @license New BSD License
 * @author Rowinson Gallego Medina <rwn.gallego@gmail.com>
 */

require_once 'Doctrine/Common/ClassLoader.php';
use Doctrine\ORM\Tools\Setup;

// TODO: Fix all this walkaround
$classLoader = new \Doctrine\Common\ClassLoader ( 'Main\Entity', __DIR__ );
$classLoader->register ();
$classLoader = new \Doctrine\Common\ClassLoader ( 'Proxies', "../app/cache/Proxies" );
$classLoader->register ();

$config = new \Doctrine\ORM\Configuration ();
$config->setMetadataCacheImpl ( new \Doctrine\Common\Cache\ArrayCache () );

$config = Setup::createAnnotationMetadataConfiguration ( array (
		__DIR__ . "/Main/Entity" 
) );

$config->setProxyDir ( __DIR__ . "/../app/cache/Proxies" );
$config->setProxyNamespace ( 'Proxies' );

$connectionOptions = parse_ini_file ( "../app/config/parameters.ini", true );

$em = \Doctrine\ORM\EntityManager::create ( $connectionOptions ['db'], $config );

$helperSet = new \Symfony\Component\Console\Helper\HelperSet ( array (
		'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper ( $em->getConnection () ),
		'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper ( $em ) 
) );
