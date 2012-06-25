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
	
}

?>