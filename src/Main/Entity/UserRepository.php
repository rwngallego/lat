<?php

namespace Main\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * User repository
 *
 * @author rowinson
 */
class UserRepository extends EntityRepository {
	/**
	 * Check if the credentials are right
	 * @param string $email
	 * @param string $password
	 * @return boolean
	 */
	public function checkLogin($email, $password) {
		$user = $this->findOneBy ( array (
				'email' => $email 
		) );
		if (! $user)
			return false;
		$realPassword = $user->getPassword ();
		if ($realPassword != $password)
			return false;
		return true;
	}
	
	/**
	 * Get all the employees
	 * @return multitype:
	 */
	public function getAllEmployees(){
		$em = $this->getEntityManager();
		$query = $em->createQuery("SELECT u FROM Main\\Entity\\User u WHERE u.role = :role");
		$query->setParameter("role", "EMPLOYEE");		
		return $query->getArrayResult();
	}
	
}

?>