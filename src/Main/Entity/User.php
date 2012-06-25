<?php

namespace Main\Entity;

/**
 * @entity(repositoryClass="Main\Entity\UserRepository")
 */
class User {
	
	/**
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */
	protected $id;
	
	/**
	 * @OneToMany(targetEntity="Schedule", mappedBy="user")
	 */
	protected $schedules;
	
	// properties
	
	/**
	 * @Column(type="string", length=70)
	 */
	protected $email;
	
	/**
	 * @Column(type="string", length=32)
	 */
	protected $password;
	
	/**
	 * @Column(type="string", length=180)
	 */
	protected $name;
	
	/**
	 * @Column(type="datetime")
	 */
	protected $lastAccess;
	
	/**
	 * @Column(type="string", length=80)
	 */
	protected $role;
	public function __construct() {
		$this->schedules = new \Doctrine\Common\Collections\ArrayCollection ();
	}
	
	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * Set email
	 *
	 * @param string $email        	
	 * @return User
	 */
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}
	
	/**
	 * Get email
	 *
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}
	
	/**
	 * Set password
	 *
	 * @param string $password        	
	 * @return User
	 */
	public function setPassword($password) {
		$this->password = $password;
		return $this;
	}
	
	/**
	 * Get password
	 *
	 * @return string
	 */
	public function getPassword() {
		return $this->password;
	}
	
	/**
	 * Set name
	 *
	 * @param string $name        	
	 * @return User
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}
	
	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * Set role
	 *
	 * @param string $role        	
	 * @return User
	 */
	public function setRole($role) {
		$this->role = $role;
		return $this;
	}
	
	/**
	 * Get role
	 *
	 * @return string
	 */
	public function getRole() {
		return $this->role;
	}
	
	/**
	 * Set lastAccess
	 *
	 * @param datetime $lastAccess
	 * @return User
	 */
	public function setLastAccess($lastAccess) {
		$this->lastAccess = $lastAccess;
		return $this;
	}
	
	/**
	 * Get lastAccess
	 *
	 * @return string
	 */
	public function getLastAccess() {
		return $this->lastAccess;
	}
	
	/**
	 * Add schedules
	 *
	 * @param Main\Entity\Schedule $schedules        	
	 * @return User
	 */
	public function addSchedule(\Main\Entity\Schedule $schedules) {
		$this->schedules [] = $schedules;
		return $this;
	}
	
	/**
	 * Get schedules
	 *
	 * @return Doctrine\Common\Collections\Collection
	 */
	public function getSchedules() {
		return $this->schedules;
	}
}