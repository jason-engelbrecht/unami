<?php

/**
 * Class NotRequired Holds answers given from the not required questions
 * @author Max Lee
 * @version 10/21/2019
 */
class NotRequired
{
    private $_heardAboutTraining;
    private $_trained;
    private $_trainedText;
    private $_certified;
    private $_certifiedText;

    /**
     * NotRequired constructor.
     * @param $_heardAboutTraining String how the applicant heard about this training
     * @param $_trained String whether the applicant has been trained before
     * @param $_trainedText String what training the applicant has completed
     * @param $_certified String whether the applicant has been certified before
     * @param $_certifiedText String what they have been certified before for
     */
    public function __construct($_heardAboutTraining, $_trained, $_trainedText, $_certified, $_certifiedText)
    {
        $this->_heardAboutTraining = $_heardAboutTraining;
        $this->_trained = $_trained;
        $this->_trainedText = $_trainedText;
        $this->_certified = $_certified;
        $this->_certifiedText = $_certifiedText;
    }

    /** Getter for how they heard about training
     * @return mixed how they heard about training
     */
    public function getHeardAboutTraining()
    {
        return $this->_heardAboutTraining;
    }

    /**
     * Getter for if they have been trained before
     * @return mixed yes or no
     */
    public function getTrained()
    {
        return $this->_trained;
    }

    /** Getter for what training they have had
     * @return mixed what training they have had
     */
    public function getTrainedText()
    {
        return $this->_trainedText;
    }

    /** Getter for if they are certified
     * @return mixed yes or no
     */
    public function getCertified()
    {
        return $this->_certified;
    }

    /** Getter for what they are certified in
     * @return mixed certifications
     */
    public function getCertifiedText()
    {
        return $this->_certifiedText;
    }
}