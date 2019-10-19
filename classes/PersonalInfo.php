<?php

/**
 * Class PersonalInfo stores all personal information for applicant
 * @author Max Lee
 * @version 10/10/19
 */
class PersonalInfo
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
    private $_email;
    private $_preference;
    private $_affiliate;
    private $_member;
    private $_emergency_name;
    private $_emergency_phone;

    /**
     * PersonalInfo constructor.
     * @param $_fname String first name of applicant
     * @param $_lname String last name of applicant
     * @param $_pronouns String the pronouns the applicant uses
     * @param $_address String the address of the applicant
     * @param $_address2 String second line of address if needed
     * @param $_city String the city of the applicant
     * @param $_state String the state where the applicant lives
     * @param $_zip String the zip code of the applicant
     * @param $_primaryPhone String the phone number of the applicant
     * @param $_primaryTime String the time the applicant would like to be called
     * @param $_alternatePhone String the alternate phone they can be reached at
     * @param $_alternateTime String the time that alternate should be called
     * @param $_email String the email they gave
     * @param $_preference String whether they prefer contact with email or phone
     * @param $_affiliate String the local affiliate they are applying to
     * @param $_member String if they are a member or nor
     * @param $_emergency_name String the name of their emergency contact
     * @param $_emergency_phone String the phone of their emergency contact
     */
    public function __construct($_fname, $_lname, $_pronouns, $_address, $_address2, $_city, $_state, $_zip,
                                $_primaryPhone, $_primaryTime, $_alternatePhone, $_alternateTime, $_email, $_preference,
                                $_affiliate, $_member, $_emergency_name, $_emergency_phone)
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
        $this->_email = $_email;
        $this->_preference = $_preference;
        $this->_affiliate = $_affiliate;
        $this->_member = $_member;
        $this->_emergency_name = $_emergency_name;
        $this->_emergency_phone = $_emergency_phone;
    }

    /** Getter for the first name
     * @return mixed first name
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /** Getter for last name
     * @return mixed last name
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /** Getter for pronouns
     * @return mixed pronouns used
     */
    public function getPronouns()
    {
        return $this->_pronouns;
    }

    /** Getter for the address
     * @return mixed address
     */
    public function getAddress()
    {
        return $this->_address;
    }

    /** Getter for second line of address
     * @return mixed second line for address
     */
    public function getAddress2()
    {
        return $this->_address2;
    }

    /** Getter for the city
     * @return mixed city
     */
    public function getCity()
    {
        return $this->_city;
    }

    /** Getter for the state
     * @return mixed state they live in
     */
    public function getState()
    {
        return $this->_state;
    }

    /** Getter for zip code
     * @return mixed zip code
     */
    public function getZip()
    {
        return $this->_zip;
    }

    /** Getter for the primary phone number
     * @return mixed primary phone
     */
    public function getPrimaryPhone()
    {
        return $this->_primaryPhone;
    }

    /** Getter for the time range for calling
     * @return mixed when to call
     */
    public function getPrimaryTime()
    {
        return $this->_primaryTime;
    }

    /** Getter for the alt phone number
     * @return mixed alt phone number
     */
    public function getAlternatePhone()
    {
        return $this->_alternatePhone;
    }

    /** Getter for the alternate time to call
     * @return mixed when to call alt phone
     */
    public function getAlternateTime()
    {
        return $this->_alternateTime;
    }

    /** Getter for the email
     * @return mixed email
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /** Getter for whether they want to called or emailed
     * @return mixed phone or email
     */
    public function getPreference()
    {
        return $this->_preference;
    }

    /** Getter for their affiliate
     * @return mixed affiliate's name
     */
    public function getAffiliate()
    {
        return $this->_affiliate;
    }

    /** Getter for if they are a NAMI member or not
     * @return mixed yes or no
     */
    public function getMember()
    {
        return $this->_member;
    }

    /** Getter for emergency contact's name
     * @return mixed name
     */
    public function getEmergencyName()
    {
        return $this->_emergency_name;
    }

    /** Getter for emergency contact's email
     * @return mixed email
     */
    public function getEmergencyPhone()
    {
        return $this->_emergency_phone;
    }


}