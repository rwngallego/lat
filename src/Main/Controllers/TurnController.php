<?php

namespace Main\Controllers;

use Main\Entity\TurnRepository;
use Main\Entity\Turn;
use LAT\Core\Controller;

/**
 * Turns controller
 *
 * @author Rowinson Gallego Medina <rwn.gallego@gmail.com>
 *        
 */
class TurnController extends Controller {
	
	/**
	 * Add a turn
	 */
	public function addAction() {
		$em = $this->getEntityManager ();
		$turnRepository = $em->getRepository ( "Main\\Entity\\Turn" );
		$userRepository = $em->getRepository ( "Main\\Entity\\User" );
		$scheduleRepository = $em->getRepository ( "Main\\Entity\\Schedule" );
		
		$scheduleId = $_GET ['scheduleId'];
		$schedule = $scheduleRepository->find ( $scheduleId );
		if ($schedule == null)
			throw new \Exception ( "The schedule was not found" );
		
		$avaibleTurns = $this->_getAvaibleTurns ( $turnRepository, $scheduleId );
		
		$userId = $_GET ['userId'];
		$user = $userRepository->find ( $userId );
		if ($user == null)
			throw new \Exception ( "The user was not found" );
		
		if ($_SERVER ["REQUEST_METHOD"] == 'POST') {
			$startTime = $_POST ['startTime'];
			$endTime = $_POST ['endTime'];
			
			$result = $turnRepository->existsTurn ( $schedule, $startTime, $endTime );
			if ($result == true) {
				throw new \Exception ( "The turn already exists in that time." );
			}
			$turn = new Turn ();
			$turn->setSchedule ( $schedule )->setStartTime ( $startTime )->setEndTime ( $endTime );
			$em->persist ( $turn );
			$em->flush ();
			
			$_SESSION ["flashMessage"] = "The Turn was added successfully";
			$this->redirect ( get_url ( "schedule_home" ) );
		}
		$this->renderView ( "Main:Turn:add.php", array (
				'schedule' => $schedule,
				'user' => $user,
				'avaibleTurns' => $avaibleTurns 
		) );
	}
	
	/**
	 * Get the avaible turns in the schedule
	 *
	 * @param TurnRepository $turnsRepository        	
	 * @param integer $scheduleId        	
	 * @return array
	 */
	private function _getAvaibleTurns(TurnRepository $turnsRepository, $scheduleId) {
		$turns = $turnsRepository->findBy ( array (
				'schedule' => $scheduleId 
		) );
		
		$avaible = array (
				8,
				9,
				10,
				11,
				12,
				13,
				14,
				15,
				16,
				17,
				18 
		);
		
		foreach ( $turns as $turn ) {
			$start = $turn->getStartTime ();
			$end = $turn->getEndTime ();
			
			$busy = array ();
			for($i = $start; $i <= $end; $i ++) {
				$busy [] = $i;
			}
			$avaible = array_values ( array_diff ( $avaible, $busy ) );
		}
		if (isset($avaible[0]) && $avaible [0] > 8)
			$avaible [] = $avaible [0] - 1;
		sort($avaible);
		
		return $avaible;
	}
}

?>