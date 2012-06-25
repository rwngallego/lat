<?php

namespace L8T\Core\Base;

/**
 * Abstract class for plugins
 * @author rowinson
 *
 */
abstract class PluginAbstract{
	
	/**
	 * Before the router dispatches
	 */
	public function beforeRouterDispatch(){
		
	}
	
	/**
	 * After the router dispatches
	 */
	public function afterRouterDispatch(){
		
	}
	
}