<?php 
namespace Main\Controllers;

use LAT\Core\Controller;

/**
 * Employee controller
 * @author Rowinson Gallego Medina <rwn.gallego@gmail.com>
 *
 */
class EmployeeController extends Controller{
	
	/**
	 * List the schedule of the employee
	 */
	public function indexAction(){
		$this->renderView ( "Main:User:index.php", array (
				'users' => array(),
				'message' => $message,
				'type' => 'view'
		) );
	}
	
}