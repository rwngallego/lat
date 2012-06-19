<?php

namespace Main\Entity;

/** @entity */
class User {

    /**
     * @Id
     * @Column(type="string", length=50)
     */
    private $email;

    //properties

    /** @Column(type="string", length=32) */
    private $password;
    
    /** @Column(type="string", length=180)*/
    private $name;
    
    /** @Column(type="date")*/
    private $birthdate;
    
    /** @Column(type="string", length=1)*/
    private $gender;
    
    /** @Column(type="string", length=25)*/
    private $phone;
    
    /** @Column(type="string", length=32)*/
    private $imageUniqueId;


    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set birthdate
     *
     * @param date $birthdate
     * @return User
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
        return $this;
    }

    /**
     * Get birthdate
     *
     * @return date 
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return User
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set imageUniqueId
     *
     * @param string $imageUniqueId
     * @return User
     */
    public function setImageUniqueId($imageUniqueId)
    {
        $this->imageUniqueId = $imageUniqueId;
        return $this;
    }

    /**
     * Get imageUniqueId
     *
     * @return string 
     */
    public function getImageUniqueId()
    {
        return $this->imageUniqueId;
    }
}