<?php

namespace Plugins;

use L8T\Core\Base\PluginAbstract;


class Auth extends PluginAbstract {

	public function beforeRouterDispatch(){
		session_start();
		if (!isset($SESSION['access']) || $_SESSION['access'] == false){
			$GLOBALS['resource'] = "Main:Index:login";
		}
		else{

		}
	}

}
