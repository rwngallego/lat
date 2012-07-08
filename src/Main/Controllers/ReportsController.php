<?php

namespace Main\Controllers;

use LAT\Core\Controller;

/**
 * Employee controller
 *
 * @author Rowinson Gallego Medina <rwn.gallego@gmail.com>
 *        
 */
class ReportsController extends Controller {
	
	/**
	 * Show the index view of the report of work of all employees
	 */
	public function allAction() {
		$em = $this->getEntityManager ();
		
		$employees = $em->getRepository ( "Main\\Entity\\User" )->getAllEmployees ();
		
		if (isset ( $_SESSION ['userReport'] ))
			$user = $_SESSION ['userReport'];
		else
			$user = $employees [0] ['id'];
		
		if (isset ( $_SESSION ["monthReport"] ))
			$month = $_SESSION ["monthReport"];
		else {
			$dt = new \DateTime ();
			$month = $dt->format ( "m" );
		}
		
		$this->renderView ( "Main:Reports:report_all.php", array (
				'employees' => $employees,
				'user' => $user,
				'month' => $month 
		) );
	}
	
	/**
	 * Show the index view of the report of work of one employee
	 */
	public function oneAction() {
		$em = $this->getEntityManager ();
		
		$userId = $_SESSION ['userId'];
		$employees = $em->getRepository ( "Main\\Entity\\User" )->getAllEmployees ();
		
		if (isset ( $_SESSION ["monthReport"] ))
			$month = $_SESSION ["monthReport"];
		else {
			$dt = new \DateTime ();
			$month = $dt->format ( "m" );
		}
		
		$user = $em->getRepository ( "Main\\Entity\\User" )->find ( $userId );
		
		$this->renderView ( "Main:Reports:report_one.php", array (
				'employees' => array (
						array (
								'id' => $user->getId (),
								'name' => $user->getName () 
						) 
				),
				'user' => $user->getId(),
				'month' => $month 
		) );
	}
	
	/**
	 * Show the report
	 */
	public function listForEmployeeAction() {
		$em = $this->getEntityManager ();
		$userId = $_POST ['userId'];
		$month = $_POST ['month'];
		
		$_SESSION ["monthReport"] = $month;
		$_SESSION ["userReport"] = $userId;
		
		$schedules = $em->getRepository ( "Main\\Entity\\Turn" )->getAllByMonthEmployee ( $month, $userId );
		$this->renderView ( "Main:Reports:listForEmployee.php", array (
				'userId' => $userId,
				'month' => $month,
				'schedules' => $schedules 
		) );
	}
}