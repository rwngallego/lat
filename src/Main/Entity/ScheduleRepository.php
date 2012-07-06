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
	public function getAvaibleByInterval($userId, $interval) {
		$em = $this->getEntityManager ();
		
		$dql = <<<EM
				SELECT DISTINCT s.date, s.id
				FROM Main\\Entity\\Schedule s
				WHERE s.user = :userId AND s.date >= :min AND s.date <= :max
EM;
		$query = $em->createQuery ( $dql );
		$query->setParameter("userId", $userId);
		$query->setParameter ( "min", $interval ['min'] );
		$query->setParameter ( "max", $interval ['max'] );
		
		$results = $query->getArrayResult ();
		$daysList = array();
		foreach($results as $item){
			$id = $item["id"];
			$day = $item["date"]->format("w");
			$daysList[$id] = $day == 0 ? 7 : $day; //0 is 7
		}
		return $daysList;
	}
}

?>