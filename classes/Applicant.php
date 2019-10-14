<?php


class Applicant
{
    private $_fname;
    private $_lname;
    private $_pronouns;
    private $_address;
    private $_address2;
    private $_city;
    private $_state;
    private $_zip;
    private $_primaryPhone;
    private $_primaryTime;
    private $_alternatePhone;
    private $_alternateTime;
    private $_emergency_name;
    private $_emergency_email;

    /**
     * Applicant constructor.
     * @param $_fname
     * @param $_lname
     * @param $_pronouns
     * @param $_address
     * @param $_address2
     * @param $_city
     * @param $_state
     * @param $_zip
     * @param $_primaryPhone
     * @param $_primaryTime
     * @param $_alternatePhone
     * @param $_alternateTime
     * @param $_emergency_name
     * @param $_emergency_email
     */
    public function __construct($_fname, $_lname, $_pronouns, $_address, $_address2, $_city, $_state, $_zip,
                                $_primaryPhone, $_primaryTime, $_alternatePhone, $_alternateTime, $_emergency_name,
                                $_emergency_email)
    {
        $this->_fname = $_fname;
        $this->_lname = $_lname;
        $this->_pronouns = $_pronouns;
        $this->_address = $_address;
        $this->_address2 = $_address2;
        $this->_city = $_city;
        $this->_state = $_state;
        $this->_zip = $_zip;
        $this->_primaryPhone = $_primaryPhone;
        $this->_primaryTime = $_primaryTime;
        $this->_alternatePhone = $_alternatePhone;
        $this->_alternateTime = $_alternateTime;
        $this->_emergency_name = $_emergency_name;
        $this->_emergency_email = $_emergency_email;
    }

    /**
     * @return mixed
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * @return mixed
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * @return mixed
     */
    public function getPronouns()
    {
        return $this->_pronouns;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->_address;
    }

    /**
     * @return mixed
     */
    public function getAddress2()
    {
        return $this->_address2;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->_city;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->_zip;
    }

    /**
     * @return mixed
     */
    public function getPrimaryPhone()
    {
        return $this->_primaryPhone;
    }

    /**
     * @return mixed
     */
    public function getPrimaryTime()
    {
        return $this->_primaryTime;
    }

    /**
     * @return mixed
     */
    public function getAlternatePhone()
    {
        return $this->_alternatePhone;
    }

    /**
     * @return mixed
     */
    public function getAlternateTime()
    {
        return $this->_alternateTime;
    }

    /**
     * @return mixed
     */
    public function getEmergencyName()
    {
        return $this->_emergency_name;
    }

    /**
     * @return mixed
     */
    public function getEmergencyEmail()
    {
        return $this->_emergency_email;
    }


}