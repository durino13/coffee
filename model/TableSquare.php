<?php

class TableSquare
{

    protected $index;
    protected $value;
    protected $poolMembership;
    
    public function __construct($index, $value)
    {
        $this->index = $index;
        $this->value = $value;
        $this->poolMembership = null;
    }
    
    public function getValue()
    {
        return $this->value;
    }
    
    public function setPoolMembership($member)
    {
        $this->poolMembership = $member;
    }
    
    public function getPoolMembership()
    {
        return $this->poolMembership;
    }
    
}
