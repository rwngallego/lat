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
}

?>