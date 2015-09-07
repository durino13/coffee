<?php

class TableSquare
{

    protected $index;
    protected $value;
    
    public function __construct($index, $value)
    {
        $this->index = $index;
        $this->value = $value;
    }
    
    public function getValue()
    {
        return $this->value;
    }
    
}
