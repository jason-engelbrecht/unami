<?php

/**
 * Class ETSLongAnswers
 */
class ETSLongAnswers
{
    private $_convict;
    private $_convictText;
    private $_availability;
    private $_education;
    private $_experience;
    private $_languages;
    private $_youngAdult;
    private $_diagnosis;
    private $_selfDisclosure;
    private $_positiveOutlook;
    private $_backgroundCheck;
    private $_whyPresenter;
    private $_personalExperience;
    private $_supportiveExperience;
    private $_recoveryMeaning;
    private $_roles;

    /**
     * ETSLongAnswers constructor.
     * @param $_convict
     * @param $_convictText
     * @param $_availability
     * @param $_education
     * @param $_experience
     * @param $_languages
     * @param $_youngAdult
     * @param $_diagnosis
     * @param $_selfDisclosure
     * @param $_positiveOutlook
     * @param $_backgroundCheck
     * @param $_whyPresenter
     * @param $_personalExperience
     * @param $_supportiveExperience
     * @param $_recoveryMeaning
     * @param $_roles
     */
    public function __construct($_convict, $_convictText, $_availability, $_education, $_experience, $_languages, $_youngAdult, $_diagnosis, $_selfDisclosure, $_positiveOutlook, $_backgroundCheck, $_whyPresenter, $_personalExperience, $_supportiveExperience, $_recoveryMeaning, $_roles)
    {
        $this->_convict = $_convict;
        $this->_convictText = $_convictText;
        $this->_availability = $_availability;
        $this->_education = $_education;
        $this->_experience = $_experience;
        $this->_languages = $_languages;
        $this->_youngAdult = $_youngAdult;
        $this->_diagnosis = $_diagnosis;
        $this->_selfDisclosure = $_selfDisclosure;
        $this->_positiveOutlook = $_positiveOutlook;
        $this->_backgroundCheck = $_backgroundCheck;
        $this->_whyPresenter = $_whyPresenter;
        $this->_personalExperience = $_personalExperience;
        $this->_supportiveExperience = $_supportiveExperience;
        $this->_recoveryMeaning = $_recoveryMeaning;
        $this->_roles = $_roles;
    }

    /**
     * @return mixed
     */
    public function getConvict()
    {
        return $this->_convict;
    }

    /**
     * @return mixed
     */
    public function getConvictText()
    {
        return $this->_convictText;
    }

    /**
     * @return mixed
     */
    public function getAvailability()
    {
        return $this->_availability;
    }

    /**
     * @return mixed
     */
    public function getEducation()
    {
        return $this->_education;
    }

    /**
     * @return mixed
     */
    public function getExperience()
    {
        return $this->_experience;
    }

    /**
     * @return mixed
     */
    public function getLanguages()
    {
        return $this->_languages;
    }

    /**
     * @return mixed
     */
    public function getYoungAdult()
    {
        return $this->_youngAdult;
    }

    /**
     * @return mixed
     */
    public function getDiagnosis()
    {
        return $this->_diagnosis;
    }

    /**
     * @return mixed
     */
    public function getSelfDisclosure()
    {
        return $this->_selfDisclosure;
    }

    /**
     * @return mixed
     */
    public function getPositiveOutlook()
    {
        return $this->_positiveOutlook;
    }

    /**
     * @return mixed
     */
    public function getBackgroundCheck()
    {
        return $this->_backgroundCheck;
    }

    /**
     * @return mixed
     */
    public function getWhyPresenter()
    {
        return $this->_whyPresenter;
    }

    /**
     * @return mixed
     */
    public function getPersonalExperience()
    {
        return $this->_personalExperience;
    }

    /**
     * @return mixed
     */
    public function getSupportiveExperience()
    {
        return $this->_supportiveExperience;
    }

    /**
     * @return mixed
     */
    public function getRecoveryMeaning()
    {
        return $this->_recoveryMeaning;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->_roles;
    }
}