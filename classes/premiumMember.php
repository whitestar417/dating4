<?php

/*
 * Premium Memberbership class
 * Inherits from Member class and includes interests
 * @author David Haas
 * @version 1.0
 * @date 6/4/20
 */
class PremiumMember extends Member
{
    private $_inDoorInterests;
    private $_outDoorInterests;

    /**
     * @return string
     */
    public function getInDoorInterests()
    {
        return $this->_inDoorInterests;
    }

    /**
     * @param string $inDoorInterests
     */
    public function setInDoorInterests($inDoorInterests)
    {
        $this->_inDoorInterests = $inDoorInterests;
    }

    /**
     * @return string
     */
    public function getOutDoorInterests()
    {
        return $this->_outDoorInterests;
    }

    /**
     * @param string $outDoorInterests
     */
    public function setOutDoorInterests($outDoorInterests)
    {
        $this->_outDoorInterests = $outDoorInterests;
    }
}