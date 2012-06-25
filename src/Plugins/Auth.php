<?php

namespace Plugins;

use L8T\Core\Base\PluginAbstract;

/**
 * Plugin class for auth issues
 * @author rowinson
 *
 */
class Auth extends PluginAbstract {

	/**
	 * (non-PHPdoc)
	 * @see \L8T\Core\Base\PluginAbstract::beforeRouterDispatch()
	 */
	public function beforeRouterDispatch(){
		session_start();
		
		if (!isset($_SESSION['access']) || $_SESSION['access'] == false){
			//The user has no access, so we redirect him to the login action
			$GLOBALS['resource'] = "Main:Index:login";
		}
	}

}
