<?php

namespace Main\Controllers;

use Doctrine\ORM\EntityManager;
use Main\Entity\Schedule;
use LAT\Core\Controller;

/**
 * Schedule controller
 *
 * @author Rowinson Gallego Medina <rwn.gallego@gmail.com>
 *        
 */
class ScheduleController extends Controller {
	
	/**
	 * Index page
	 */
	public function indexAction() {
		$em = $this->getEntityManager ();
		
		$employees = $em->getRepository ( "Main\\Entity\\User" )->getAllEmployees ();
		
		$message = "";
		if (isset ( $_SESSION ['flashMessage'] )) {
			$message = $_SESSION ['flashMessage'];
			unset ( $_SESSION ['flashMessage'] );
		}
		
		$this->renderView ( "Main:Schedule:index.php", array (
				'employees' => $employees,
				'message' => $message 
		) );
	}
	
	/**
	 * Get the list of schedules for the employee
	 */
	public function listForEmployeeAction() {
		// get id from POST... and then the other stuff
		$id = $_POST ['id'];
		$date = $_POST ['date'];
		
		$timestap = strtotime ( $date );
		$week = date ( "W", $timestap );
		$year = date ( "Y", $timestap );
		
		$dateInterval = $this->getDateIntervalFromWeek ( $week, $year );
		$daysList = $this->getEntityManager ()->getRepository ( "Main\\Entity\\Schedule" )->getAvaibleByInterval ( $dateInterval );
		
		$this->renderView ( "Main:Schedule:listForEmployee.php", array (
				'id' => $id,
				'date' => $date,
				'daysList' => $daysList 
		) );
	}
	
	/**
	 * Add a new schedule
	 */
	public function addAction() {
		$em = $this->getEntityManager ();
		
		if (! isset ( $_GET ['id'] ))
			throw new \Exception ( "The id was not defined" );
		$id = $_GET ['id'];
		$user = $em->getRepository ( "Main\\Entity\\User" )->find ( $id );
		if (! $user)
			throw new \Exception ( "The user with id $id was not foud" );
		
		$date = $_GET ['date'];
		
		$this->checkDate ( $em, $id, $date );
		
		if ($_SERVER ['REQUEST_METHOD'] == "POST") {
			if ($_POST ["answer"] == "yes") {
				$schedule = new Schedule ();
				$schedule->setDate ( new \DateTime ( $date ) );
				$schedule->setUser ( $user );
				
				$em->persist ( $schedule );
				$em->flush ();
				$_SESSION ["flashMessage"] = "The Schedule was added successfully";
			}
			$this->redirect ( get_url ( "schedule_home" ) );
		}
		
		$this->renderView ( "Main:Schedule:add.php", array (
				'user' => $user,
				'date' => $date 
		) );
	}
	
	/**
	 * Check the parameter date
	 *
	 * @param EntityManager $em        	
	 * @param int $id        	
	 * @param string $date        	
	 * @throws \Exception
	 */
	private function checkDate(EntityManager $em, $id, $date) {
		if (! $date)
			throw new \Exception ( "The date was not found" );
		$result = preg_match ( "/^(\d{4})-(\d\d)-(\d\d)$/", $date, $matches );
		if ($result != 1)
			throw new \Exception ( "The date is not well formated" );
		$date = $em->getRepository ( "Main\\Entity\\Schedule" )->findOneBy ( array (
				'date' => new \DateTime ( $date ),
				'user' => $id 
		) );
		if ($date)
			throw new \Exception ( "The user already has an schedule in that date" );
	}
	
	/**
	 * Get the day interval from the week number with Sunday as first day
	 *
	 * @param integer $week_number        	
	 * @param integer $year        	
	 * @return array Array of dates
	 */
	private function getDateIntervalFromWeek($week_number, $year) {
		$interval = array ();
		$interval ['min'] = date ( 'Y-m-d', strtotime ( $year . "W" . $week_number . '1' ) );
		$interval ['max'] = date ( 'Y-m-d', strtotime ( $year . "W" . $week_number . '7' ) );
		return $interval;
	}
}