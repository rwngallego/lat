<?php

namespace Main\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Schedule repository
 *
 * @author rowinson
 */
class ScheduleRepository extends EntityRepository {
	/**
	 * Get the days where there are schedules.
	 * @param array $interval 'min' and 'max' elements
	 * @return multitype:
	 */
	public function getAvaibleByInterval($interval) {
		$em = $this->getEntityManager ();
		
		$dql = <<<EM
				SELECT s.date
				FROM Main\\Entity\\Schedule s
				WHERE s.date >= :min AND s.date <= :max
EM;
		$query = $em->createQuery ( $dql );
		
		$query->setParameter ( "min", $interval ['min'] );
		$query->setParameter ( "max", $interval ['max'] );
		
		$results = $query->getArrayResult ();
		$daysList = array();
		foreach($results as $date){
			$daysList[] = $date["date"]->format("w");
		}
		return $daysList;
	}
}

?>