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
 * @subpackage Base
 * @license New BSD License
 */
namespace LAT\Core\Base;

/**
 * Abstract class for plugins
 * 
 * @author Rowinson Gallego Medina <rwn.gallego@gmail.com>
 *        
 */
abstract class PluginAbstract {
	
	/**
	 * Before the router dispatches
	 */
	public function beforeRouterDispatch() {
	}
	
	/**
	 * After the router dispatches
	 */
	public function afterRouterDispatch() {
	}
}