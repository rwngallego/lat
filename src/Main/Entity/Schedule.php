<?php

namespace Main\Entity;

/**
 * @entity(repositoryClass="Main\Entity\ScheduleRepository")
 */
class Schedule {
	
	/**
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */
	protected $id;
	
	/**
	 * @ManyToOne(targetEntity="User", inversedBy="schedules")
	 * @JoinColumns({
     *   @JoinColumn(name="User_id", referencedColumnName="id", nullable=false)
     * })
	 */
	protected $user;
	
	/**
	 * @OneToMany(targetEntity="Turn", mappedBy="schedule")
	 */
	protected $turns;
	
	// properties
	
	/**
	 * @Column(type="date", unique=false)
	 */
	protected $date;
	public function __construct() {
		$this->turns = new \Doctrine\Common\Collections\ArrayCollection ();
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
	 * Set date
	 *
	 * @param date $date        	
	 * @return Schedule
	 */
	public function setDate($date) {
		$this->date = $date;
		return $this;
	}
	
	/**
	 * Get date
	 *
	 * @return date
	 */
	public function getDate() {
		return $this->date;
	}
	
	/**
	 * Set user
	 *
	 * @param Main\Entity\User $user        	
	 * @return Schedule
	 */
	public function setUser(\Main\Entity\User $user = null) {
		$this->user = $user;
		return $this;
	}
	
	/**
	 * Get user
	 *
	 * @return Main\Entity\User
	 */
	public function getUser() {
		return $this->user;
	}
	
	/**
	 * Add turns
	 *
	 * @param Main\Entity\Turn $turns        	
	 * @return Schedule
	 */
	public function addTurn(\Main\Entity\Turn $turns) {
		$this->turns [] = $turns;
		return $this;
	}
	
	/**
	 * Get turns
	 *
	 * @return Doctrine\Common\Collections\Collection
	 */
	public function getTurns() {
		return $this->turns;
	}
}