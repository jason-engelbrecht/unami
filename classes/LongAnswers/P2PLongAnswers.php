<?php

/**
 * Class P2PLongAnswers Hold all the answers from the P2P long answers
 * @author Maxwell Lee
 * @version 11/21/2019
 */
class P2PLongAnswers
{
    private $_convict;
    private $_convictText;
    private $_whyLeader;
    private $_mentalHealth;
    private $_giveBack;

    /**
     * P2PLongAnswers constructor.
     * @param $_convict
     * @param $_convictText
     * @param $_whyLeader
     * @param $_mentalHealth
     * @param $_giveBack
     */
    public function __construct($_convict, $_convictText, $_whyLeader, $_mentalHealth, $_giveBack)
    {
        $this->_convict = $_convict;
        $this->_convictText = $_convictText;
        $this->_whyLeader = $_whyLeader;
        $this->_mentalHealth = $_mentalHealth;
        $this->_giveBack = $_giveBack;
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
    public function getWhyLeader()
    {
        return $this->_whyLeader;
    }

    /**
     * @return mixed
     */
    public function getMentalHealth()
    {
        return $this->_mentalHealth;
    }

    /**
     * @return mixed
     */
    public function getGiveBack()
    {
        return $this->_giveBack;
    }
}