<?php

namespace Main\Entity;

/**
 * @entity
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
	 */
	protected $turns;
	
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
     * Set turns
     *
     * @param Main\Entity\Schedule $turns
     * @return Turn
     */
    public function setTurns(\Main\Entity\Schedule $turns = null)
    {
        $this->turns = $turns;
        return $this;
    }

    /**
     * Get turns
     *
     * @return Main\Entity\Schedule 
     */
    public function getTurns()
    {
        return $this->turns;
    }
}