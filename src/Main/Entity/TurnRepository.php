<?php

namespace Main\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Turn repository
 *
 * @author rowinson
 */
class TurnRepository extends EntityRepository {
	public function existsTurn($scheduleId, $startTime, $endTime) {
		$dql = <<<EM
		SELECT COUNT(t.id) FROM Main\\Entity\\Turn t
		WHERE t.schedule = :schedule AND t.startTime = :startTime AND t.endTime = :endTime 
EM;
		$query = $this->getEntityManager ()->createQuery ($dql);
		$query->setParameter ( "schedule", $scheduleId );
		$query->setParameter ( "startTime", $startTime );
		$query->setParameter ( "endTime", $endTime );
		
		$result = $query->getSingleResult();
		if (intval($result[1]) == 0)
			return false;
		else
			return true;
	}
	
	/**
	 * Get all the turns of the user in the given month
	 * @param integer $month
	 * @param integer $userId
	 * @return multitype:
	 */
	public function getAllByMonthEmployee($month, $userId){
		$em = $this->getEntityManager();

		$dql = <<<EM
		SELECT t, s FROM Main\\Entity\\Schedule s
		LEFT JOIN s.turns t
		WHERE s.user = :userId AND SUBSTRING(s.date, 6, 2) = :month
		ORDER BY s.date ASC
EM;
		$query = $em->createQuery($dql);
		$query->setParameter("month", $month);
		$query->setParameter("userId", $userId);
		$results = $query->getArrayResult();
		return $results;
	}
}

?>