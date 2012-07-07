<?php

namespace Main\Entity;

/**
 * @entity(repositoryClass="Main\Entity\TurnRepository")
 */
class Turn {
	
	/**
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */
	protected $id;
	
	/**
	 * @ManyToOne(targetEntity="Schedule", inversedBy="turns")
	 * @JoinColumns({
     *   @JoinColumn(name="Schedule_id", referencedColumnName="id", nullable=false)
     * })
	 */
	protected $schedule;
	
	// properties
	
	/**
	 * @Column(type="smallint")
	 */
	protected $startTime;
	
	/**
	 * @Column(type="smallint")
	 */
	protected $endTime;
	
	

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set startTime
     *
     * @param smallint $startTime
     * @return Turn
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
        return $this;
    }

    /**
     * Get startTime
     *
     * @return smallint 
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param smallint $endTime
     * @return Turn
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
        return $this;
    }

    /**
     * Get endTime
     *
     * @return smallint 
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set schedule
     *
     * @param Main\Entity\Schedule $schedule
     * @return Turn
     */
    public function setSchedule(\Main\Entity\Schedule $schedule = null)
    {
        $this->schedule = $schedule;
        return $this;
    }

    /**
     * Get schedule
     *
     * @return Main\Entity\Schedule 
     */
    public function getSchedule()
    {
        return $this->schedule;
    }
}