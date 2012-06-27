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
 * @package src/Plugins
 * @subpackage Auth
 * @license New BSD License
 */

namespace Plugins;

use LAT\Core\Base\PluginAbstract;

/**
 * Plugin class for auth issues
 * @author Rowinson Gallego Medina <rwn.gallego@gmail.com>
 *
 */
class Auth extends PluginAbstract {

	/**
	 * (non-PHPdoc)
	 * @see \LAT\Core\Base\PluginAbstract::beforeRouterDispatch()
	 */
	public function beforeRouterDispatch(){
		session_start();
		
		if (!isset($_SESSION['access']) || $_SESSION['access'] == false){
			//The user has no access, so we redirect him to the login action
			$GLOBALS['resource'] = "Main:Index:login";
		}
	}

}
