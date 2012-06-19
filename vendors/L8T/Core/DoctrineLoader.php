<?php

namespace L8T\Core;

use Doctrine\ORM\EntityManager;

/**
 * Doctrine loader. Implements singleton
 * @author rowinson
 *
 */
class DoctrineLoader{

	/**
	 * Instance
	 * @var L8T\Core\DoctrineLoader
	 */
	private static $instance;
	private function __construct() {
	}
	public function __clone() {
		trigger_error ( 'Clone is not allowed.', E_USER_ERROR );
	}
	public function __wakeup() {
		trigger_error ( 'Unserializing is not allowed.', E_USER_ERROR );
	}
	/**
	 * Retrieve an instance of the class
	 * @return L8T\Core\DoctrineLoader
	 */
	public static function getInstance() {
		if (! isset ( self::$instance )) {
			$className = __CLASS__;
			self::$instance = new $className ();
		}
		return self::$instance;
	}

	/**
	 * Entity manager
	 * @var \Doctrine\ORM\EntityManager
	 */
	private $entityManager = null;

	/**
	 * Inits the connection
	 * @param array $dbParams
	 */
	public function init($dbParams = array()){
		// Configuration
		$config = new \Doctrine\ORM\Configuration ();
		if ('development' == APPLICATION_ENV) {
			$cache = new \Doctrine\Common\Cache\ArrayCache ();
		} else {
			$cache = new \Doctrine\Common\Cache\ApcCache ();
		}
		$config->setMetadataCacheImpl ( $cache );
		$config->setQueryCacheImpl ( $cache );

		// Annotations and proxies
		// XXX: Manage the set of annotations and proxies directories/namespaces
		$driverImpl = $config->newDefaultAnnotationDriver ( array (
				'src/Main/Entity' ) );
		$config->setMetadataDriverImpl ( $driverImpl );
		$config->setProxyDir ( 'app/cache/Proxies' );
		$config->setProxyNamespace ( 'Proxies' );
		$config->setAutoGenerateProxyClasses ( ('development' == APPLICATION_ENV) );

		// Connection
		$connectionParams = $dbParams;

		// Entity manager
		$conn = \Doctrine\DBAL\DriverManager::getConnection ( $connectionParams );
		$this->em = EntityManager::create ( $conn, $config );
	}

	/**
	 * Get the entity manager
	 * @return \Doctrine\ORM\EntityManager
	 */
	public function getEntityManager(){
		return $this->em;
	}

}