<?php

/**
 * Class LongAnswers Hold the long answers given by the applicant
 * @author Max Lee
 * @version 10/19/19
 */
class FSGLongAnswers
{
    private $_relativeMentalIllness;
    private $_relativeMentalIllnessText;
    private $_convict;
    private $_convictText;
    private $_whyFacilitator;
    private $_experience;
    private $_coFacWhom;
    private $_coFacWhomText;
    private $_coFacWhere;
    private $_coFacWhereText;

    /**
     * LongAnswers constructor.
     * @param $_relativeMentalIllness String if the applicant has a relative with a mental illness
     * @param $_relativeMentalIllnessText String response for question
     * @param $_convict String if the applicant is a convict
     * @param $_convictText String what the response is
     * @param $_whyFacilitator String why he applicant wants to be a facilitator
     * @param $_experience String what experience the applicant has
     * @param $_coFacWhom String if they know who they want to co facilitate with
     * @param $_coFacWhomText String who they want to co facilitate with
     * @param $_coFacWhere String if the applicant knows where they want to co facilitate
     * @param $_coFacWhereText String where the applicant wants to co facilitate
     */
    public function __construct($_relativeMentalIllness, $_relativeMentalIllnessText, $_convict, $_convictText,
                                $_whyFacilitator, $_experience, $_coFacWhom, $_coFacWhomText, $_coFacWhere, $_coFacWhereText)
    {
        $this->_relativeMentalIllness = $_relativeMentalIllness;
        $this->_relativeMentalIllnessText = $_relativeMentalIllnessText;
        $this->_convict = $_convict;
        $this->_convictText = $_convictText;
        $this->_whyFacilitator = $_whyFacilitator;
        $this->_experience = $_experience;
        $this->_coFacWhom = $_coFacWhom;
        $this->_coFacWhomText = $_coFacWhomText;
        $this->_coFacWhere = $_coFacWhere;
        $this->_coFacWhereText = $_coFacWhereText;
    }

    /** Getter for if they have a relative with mental illness
     * @return mixed yes or no
     */
    public function getRelativeMentalIllness()
    {
        return $this->_relativeMentalIllness;
    }

    /** Getter for if they are a convicted felon
     * @return mixed yes or no
     */
    public function getConvict()
    {
        return $this->_convict;
    }

    /** Getter for why they want to be a facilitator
     * @return mixed reasons why they applied
     */
    public function getWhyFacilitator()
    {
        return $this->_whyFacilitator;
    }

    /** Getter for the experience they list
     * @return mixed relevant experience
     */
    public function getExperience()
    {
        return $this->_experience;
    }

    /** Getter for if they know whom they want to co facilitate with
     * @return mixed who to facilitate with
     */
    public function getCoFacWhom()
    {
        return $this->_coFacWhom;
    }

    /** Getter for their response
     * @return mixed who to facilitate with
     */
    public function getCoFacWhomText()
    {
        return $this->_coFacWhomText;
    }

    /** Getter for if they know where they want to co facilitate with
     * @return mixed yes or no
     */
    public function getCoFacWhere()
    {
        return $this->_coFacWhere;
    }

    /** Getter for their response on where they want to facilitate
     * @return mixed where they want to facilitate
     */
    public function getCoFacWhereText()
    {
        return $this->_coFacWhereText;
    }

    /** Getter for the response
     * @return String what they said
     */
    public function getRelativeMentalIllnessText()
    {
        return $this->_relativeMentalIllnessText;
    }

    /** Getter for their response
     * @return String what they said
     */
    public function getConvictText()
    {
        return $this->_convictText;
    }


}