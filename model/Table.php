<?php

class Table
{

    protected $tableSquareCount;
    protected $squaresArray;

    public function __construct()
    {
        $this->tableSquareCount = 399;
        $this->pourCoffee();
    }
    
      /**
     * getRandomWeightedElement()
     * Utility function for getting random values with weighting.
     * Pass in an associative array, such as array('A'=>5, 'B'=>45, 'C'=>50)
     * An array like this means that "A" has a 5% chance of being selected, "B" 45%, and "C" 50%.
     * The return value is the array key, A, B, or C in this case.  Note that the values assigned
     * do not have to be percentages.  The values are simply relative to each other.  If one value
     * weight was 2, and the other weight of 1, the value with the weight of 2 has about a 66%
     * chance of being selected.  Also note that weights should be integers.
     * 
     * @param array $weightedValues
     */
    private function getRandomWeightedElement(array $weightedValues)
    {
        $rand = mt_rand(1, (int) array_sum($weightedValues));

        foreach ($weightedValues as $key => $value)
        {
            $rand -= $value;
            if ($rand <= 0)
            {
                return $key;
            }
        }
    }

    /**
     * Initialize the table data with random values
     */
    private function pourCoffee()
    {

//        $testValues = [0, 1, 0, 1, 0, 1, 0, 0, 1, 1, 0, 1, 0, 0, 1, 0, 0, 1, 0, 1, 0, 1, 0, 0, 1, 0, 0, 0, 0, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, 1, 0, 0, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 1, 0, 1, 1, 0, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 0, 1, 1, 0, 1, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, 1, 0, 0, 1, 0, 1, 0, 1, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0, 1, 1, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 0, 1, 0, 0, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 1, 1, 0, 0, 1, 1, 0, 1, 1, 1, 1, 1, 0, 1, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 1, 1, 1, 0, 0, 1, 0, 1, 1, 1, 1, 0, 0, 0, 1, 0, 0, 1, 0, 1, 0, 1, 0, 0, 0, 0, 1, 1, 1, 0, 1, 0, 0, 0, 1, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 1, 1, 1, 0, 1, 0, 0, 1, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 1, 1, 1, 1, 0, 0, 1, 0, 1, 1, 0, 1, 0, 0, 1, 1, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 0, 1, 1, 0, 1, 0, 1, 1, 0, 0, 1, 0, 1, 0, 1, 1, 0, 0, 1, 1, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 1, 1, 0, 0, 1, 0, 0, 0, 1, 0, 1, 0, 0, 1, 1, 1, 0, 0, 1, 0, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1];
        
        for ($i = 0; $i < 400; $i++)
        {
             $this->squaresArray[$i] = new TableSquare($i, $this->getRandomWeightedElement(array(0=>60, 1=>40)));
        }
    }

    /**
     * Create the table
     */
    public function getSquares()
    {
        return $this->squaresArray;
    }

    /**
     * Clean the table 
     */
    public function clean($pool)
    {
        foreach ($pool as $poolIndex)
        {
            $this->squaresArray[$poolIndex] = new TableSquare($poolIndex, 0);
        }
    }

    /**
     * This function will extract the patch out of the table and it will 
     * identify all the coffee beans next to the square ..
     * @param type $index
     * @return array
     */
    public function extractPoolAtIndex($index)
    {
        $squaresScanned = array();
        $squaresToScan = array();

        // Rescan all the neighbour squares next to this scanned square and store the result in squaresToScan
        $squaresToScan = $this->getNeighbours($index);

        // add index of the founded square into squaresScanned
        array_push($squaresScanned, $index);

        // Loop over the squaresToScan array and scan every square in the array
        while (!empty($squaresToScan))
        {

            $temp = array();
            $loop = 0;

            foreach ($squaresToScan as $squareIndex)
            {

                // for every coffee square get the index of another neighbour squares 
                $ns = $this->getNeighbours($squareIndex);

                // add the neighbours to scan to the list of the squarestoscan
                $temp = array_unique(array_merge($temp, $ns));

                // add the scanned square into 'squaresScanned'
                array_push($squaresScanned, $squareIndex);
            }

            $squaresToScan = array_diff($temp, $squaresScanned);
        }

        return $squaresScanned;
    }

    public function getSquareAtIndex($index)
    {
        return $this->squaresArray[$index];
    }

    /*
     * This function will return an array of Squere objects next to this square.
     */

    public function getNeighbours($index)
    {
        $offsets = $this->getOffsets($index);
        $squaresFound = array();

        foreach ($offsets as $offset)
        {
            if (array_key_exists($index + $offset, $this->getSquares()))
            {
                if ($this->getSquareAtIndex($index + $offset)->getValue() === 1)
                {
                    array_push($squaresFound, $index + $offset);
                }
            }
        }

        return $squaresFound;
    }

    /**
     * Because I use a 1 dimmensional array as an input, this function will calculate offsets for indexes, which are at the border
     * of the table .. Nasty hardcoded stuff, but works for the purpose of the application ..
     * Offcourse, I would need to calculate indexes in case the table size is different ..
     */
    private function getOffsets($index)
    {
        $leftTableIndexes = array(0, 20, 40, 60, 80, 100, 120, 140, 160, 180, 200, 220, 240, 260, 280, 300, 320, 340, 360, 380, 400);
        $rightTableIndexes = array(19, 39, 59, 79, 99, 119, 139, 159, 179, 199, 219, 239, 259, 279, 299, 319, 339, 359, 379, 399);

        $allOffsets = array(-21, -20, -19, -1, 1, 19, 20, 21);
        $offsetsForLeft = array(-20, -19, 1, 20, 21);
        $offsetsForRight = array(-21, -20, -1, 19, 20);

        if (in_array($index, $leftTableIndexes))
        {
            return $offsetsForLeft;
        } else if (in_array($index, $rightTableIndexes))
        {
            return $offsetsForRight;
        } else
        {
            return $allOffsets;
        }
    }

}
