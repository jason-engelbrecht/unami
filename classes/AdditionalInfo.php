<?php

/**
 * Class AdditionalInfo Holds the additional information given by the affiliate
 * @author Maxwell Lee
 * @version 10/19/19
 */
class AdditionalInfo
{
    private $_specialNeeds;
    private $_specialNeedsText;
    private $_serviceAnimal;
    private $_serviceAnimalText;
    private $_movementDisability;
    private $_movementDisabilityText;
    private $_needAccommodations;
    private $_needRoom;
    private $_daysRooming;
    private $_roommate;
    private $_gender;
    private $_roommateGender;
    private $_cpap;
    private $_cpapRoommate;
    private $_singleRoom;

    /**
     * AdditionalInfo constructor.
     * @param $_specialNeeds String whether the applicant has special needs
     * @param $_specialNeedsText String special needs details
     * @param $_serviceAnimal String whether the applicant has a service animal
     * @param $_serviceAnimalText String service animal details
     * @param $_movementDisability String whether the applicant has a movement disability
     * @param $_movementDisabilityText String movement disability details
     * @param $_needAccommodations String whether the applicant needs accommodations
     * @param $_needRoom String if the applicant needs a room
     * @param $_daysRooming mixed the days the applicant is rooming
     * @param $_roommate String whether they want a roommate or not
     * @param $_gender String applicant's gender
     * @param $_roommateGender String the gender of whom they want to room with
     * @param $_cpap String if they use a cpap or not
     * @param $_cpapRoommate String if they mind sleeping with a cpap user
     * @param $_singleRoom String if they want to pay for a single room
     */
    public function __construct($_specialNeeds, $_specialNeedsText, $_serviceAnimal, $_serviceAnimalText,
                                $_movementDisability, $_movementDisabilityText, $_needAccommodations, $_needRoom,
                                $_daysRooming, $_roommate, $_gender, $_roommateGender, $_cpap, $_cpapRoommate,
                                $_singleRoom)
    {
        $this->_specialNeeds = $_specialNeeds;
        $this->_specialNeedsText = $_specialNeedsText;
        $this->_serviceAnimal = $_serviceAnimal;
        $this->_serviceAnimalText = $_serviceAnimalText;
        $this->_movementDisability = $_movementDisability;
        $this->_movementDisabilityText = $_movementDisabilityText;
        $this->_needAccommodations = $_needAccommodations;
        $this->_needRoom = $_needRoom;
        $this->_daysRooming = $_daysRooming;
        $this->_roommate = $_roommate;
        $this->_gender = $_gender;
        $this->_roommateGender = $_roommateGender;
        $this->_cpap = $_cpap;
        $this->_cpapRoommate = $_cpapRoommate;
        $this->_singleRoom = $_singleRoom;
    }

    /** Getter for special needs
     * @return mixed if they have special needs
     */
    public function getSpecialNeeds()
    {
        return $this->_specialNeeds;
    }

    /** Getter for if they have a service animal
     * @return mixed if they have a service animal
     */
    public function getServiceAnimal()
    {
        return $this->_serviceAnimal;
    }

    /** Getter for if they have a movement disability
     * @return mixed if they have a movement disability
     */
    public function getMovementDisability()
    {
        return $this->_movementDisability;
    }

    /** Getter if they don't need accommodations
     * @return mixed no need for accommodations
     */
    public function getNeedAccommodations()
    {
        return $this->_needAccommodations;
    }

    /** Getter for if they need a room or not
     * @return mixed room needed
     */
    public function getNeedRoom()
    {
        return $this->_needRoom;
    }

    /** Getter for what days they are rooming
     * @return mixed days rooming
     */
    public function getDaysRooming()
    {
        return $this->_daysRooming;
    }

    /** A method to see if a day is needed for rooming
     * @param $day String the day being looked for
     * @return boolean if day is needed
     */
    public function containsDaysRooming($day)
    {
        foreach($this->_daysRooming as $value)
        {
            if($day == $value)
            {
                return true;
            }
        }
        return false;
    }

    /** Getter for if they need a roommate
     * @return mixed roommate
     */
    public function getRoommate()
    {
        return $this->_roommate;
    }

    /** Getter for their gender
     * @return mixed gender
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /** Getter for what gender they want to room with
     * @return mixed roommates gender
     */
    public function getRoommateGender()
    {
        return $this->_roommateGender;
    }

    /** Getter for if they use a cpap
     * @return mixed if they use a cpap
     */
    public function getCpap()
    {
        return $this->_cpap;
    }

    /** Getter for if they mind sleeping with a cpap user
     * @return mixed yes for fine no for not
     */
    public function getCpapRoommate()
    {
        return $this->_cpapRoommate;
    }

    /** Getter for if they want a one person room
     * @return mixed yes or no
     */
    public function getSingleRoom()
    {
        return $this->_singleRoom;
    }

    /**
     * Gets the special needs details
     * @return String details
     */
    public function getSpecialNeedsText()
    {
        return $this->_specialNeedsText;
    }

    /**
     * Gets the details of the service animal
     * @return String details
     */
    public function getServiceAnimalText()
    {
        return $this->_serviceAnimalText;
    }

    /**
     * Gets the details of movement disability
     * @return String details
     */
    public function getMovementDisabilityText()
    {
        return $this->_movementDisabilityText;
    }
}