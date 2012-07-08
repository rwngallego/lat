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
	 * List the weekly schedule of the employee
	 */
	public function indexAction(){
		$em = $this->getEntityManager();
		$userId = $_SESSION['userId'];
		
		if (isset ( $_SESSION ["dateSchedule"] ))
			$date = $_SESSION ["dateSchedule"];
		else
			$date = new \DateTime ();
		
		$user = $em->getRepository("Main\\Entity\\User")->find($userId);
		
		$this->renderView ( "Main:Employee:index.php", array (
				'employees' => array(array(
						'id' => $user->getId(),
						'name' => $user->getName())),
				'message' => "",
				'user' => $user->getId(),
				'date' => $date,
		) );
	}
	
	/**
	 * Get the list of schedules for the employee
	 */
	public function weeklyListAction() {
		$em = $this->getEntityManager();
		$scheduleRepository = $em->getRepository("Main\\Entity\\Schedule");
		$turnsRepository = $em->getRepository("Main\\Entity\\Turn");
		// get id from POST... and then the other stuff
		$userId = $_POST ['id'];
		$date = new \DateTime($_POST ['date']);
	
		$timestap = $date->getTimestamp();
		$week = date ( "W", $timestap );
		$year = date ( "Y", $timestap );
	
		$_SESSION ["dateSchedule"] = $date;
		$_SESSION["userSchedule"] = $userId;
	
		$schedule = $scheduleRepository->findOneBy(array('user' => $userId, 'date' => $date));
		if ($schedule != null){
			$turns = $turnsRepository->findBy(array('schedule' => $schedule->getId()));
		}
		else
			$turns = array();
	
		$dateInterval = $this->getDateIntervalFromWeek ( $week, $year );
		$daysList = $scheduleRepository->getAvaibleByInterval ( $userId, $dateInterval );
	
		$this->renderView ( "Main:Employee:listSchedule.php", array (
				'userId' => $userId,
				'date' => $date,
				'daysList' => $daysList,
				'turns' => $turns,
		) );
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