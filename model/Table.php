<?

class Table
{
	
	protected $tableSquareCount;
	protected $tableDataArray;

	public function __construct()
	{
		$this->tableSquareCount = 399;
		$this->init();
	}

	/**
	* Initialize the table data with random values
	*/
	private function init()
	{
		for ($i=0; $i <= $this->tableSquareCount; $i++) {
			$this->tableDataArray[$i] = rand(0, 1);
		}
		// $this->tableDataArray = [1,1,0,1,0,1,1,0,0,1,0,1,1,0,0,1,1,1,1,0,0,0,1,1,0,1,0,0,0,1,0,1,1,0,0,1,1,0,0,1,1,0,0,0,0,1,0,0,1,1,1,1,0,1,1,1,0,1,1,0,0,1,0,0,1,1,0,1,1,0,0,1,1,1,1,0,1,0,0,0,0,0,0,1,1,1,0,1,1,1,0,0,1,0,0,0,1,0,1,1,1,0,0,0,0,0,0,1,0,1,1,0,1,0,1,1,1,0,0,1,0,1,1,1,0,0,1,0,0,1,1,0,0,1,0,0,0,0,1,0,0,1,1,1,1,1,0,1,1,1,0,1,1,0,0,1,0,0,1,1,0,1,1,0,0,1,0,0,0,0,1,0,0,0,0,0,1,1,1,1,1,0,0,0,0,1,1,0,1,1,0,0,0,1,0,1,1,1,0,0,0,0,1,0,0,0,0,0,1,0,0,1,0,0,1,0,0,1,1,0,1,0,0,1,1,0,1,1,0,0,1,0,0,0,1,1,0,1,1,0,0,1,1,0,0,1,1,0,1,0,0,0,1,0,0,0,1,1,0,0,1,1,1,0,0,0,1,1,0,1,0,0,1,0,0,1,1,1,0,0,0,1,0,1,0,0,0,0,0,1,0,0,1,1,0,1,0,1,1,0,1,1,1,0,0,0,0,1,0,0,1,1,0,0,1,0,1,1,0,1,0,1,0,1,1,0,1,1,0,1,0,1,1,0,0,1,0,0,0,0,1,0,1,1,1,0,0,0,0,1,0,1,0,0,1,0,0,1,0,1,0,1,1,0,1,1,1,0,1,0,0,0,1,0,0,0,1,0,0,0,1,1,0,1,1,1,0,0,1,0,1,1,1,0,1,1,1,1,1,1];
	}	

	/**
	* Create the table
	*/
	public function create()
	{
		return $this->tableDataArray;
	}

	/**
	* Clean the table 
	*/
	public function clean($pool)
	{
		foreach ($pool as $poolIndex) {
			$this->tableDataArray[$poolIndex] = 0;
		}
	}

	public function extractPoolAtIndex($index)
	{
		$squaresScanned = [];
		$squaresToScan = [];

		// Rescan all the neighbour squares next to this scanned square and store the result in squaresToScan
		$squaresToScan = $this->getNeighbourCoffeeSquaresIndexes($index);
		// pr("Indexes found next to $index:", $squaresToScan);		

		// add index of the founded square into squaresScanned
		array_push($squaresScanned, $index);
		// pr("Squares scanned so far: ", $squaresScanned);
		// pr("Squares to scan in the next loop: ", $squaresToScan);

		// Loop over the squaresToScan array and scan every square in the array
		while (!empty($squaresToScan))
		{

			$temp = [];
			$loop = 0;

			foreach ($squaresToScan as $squareIndex) 
			{

			 	// for every coffee square get the index of another neighbour squares 
			 	$ns = $this->getNeighbourCoffeeSquaresIndexes($squareIndex);
			 	// pr("Squares next to $squareIndex: ", $ns);

			 	// add the neighbours to scan to the list of the squarestoscan
			 	$temp = array_unique(array_merge($temp, $ns));
			 	// pr("Squares to scan: ", $temp);

				// add the scanned square into 'squaresScanned'
				array_push($squaresScanned, $squareIndex);
				// pr('Squares scanned: ', $squaresScanned);

			}

			$squaresToScan = array_diff($temp, $squaresScanned);
			// pr('Squares to scan in the next loop: ', $squaresToScan);

		}		

		return $squaresScanned;
	}

	/** 
	* This function will count coffee squares next to a square with a specific index
	*/
	public function getNeighbourCoffeeSquaresIndexes($index)	
	{
		$offsets = $this->getOffsets($index);
		$indexesFound = [];

		foreach ($offsets as $offset) {

			if (array_key_exists($index+$offset, $this->tableDataArray))
			{
				if ($this->tableDataArray[$index+$offset] === 1)
				{
					array_push($indexesFound, $index+$offset);
				}						
			}			
						
		}

		return $indexesFound;
	}

	/** 
	* Function will get a position 
	*/
	private function getOffsets($index)
	{
		$leftTableIndexes = [0, 20, 40, 60, 80, 100, 120, 140, 160, 180, 200, 220, 240, 260, 280, 300, 320, 340, 360, 380, 400];
		$rightTableIndexes = [19, 39, 59, 79, 99, 119, 139, 159, 179, 199, 219, 239, 259, 279, 299, 319, 339, 359, 379, 399];

		$allOffsets = [-21, -20, -19, -1, 1, 19, 20, 21];
		$offsetsForLeft = [-20, -19, 1, 20, 21];
		$offsetsForRight = [-21, -20, -1, 1, 20];		

		if (in_array($index, $leftTableIndexes))
		{
			return $offsetsForLeft;
		} else if (in_array($index, $rightTableIndexes))
		{
			return $offsetsForRight;
		} else {
			return $allOffsets;
		}

	}

	public function getValueAtIndex($index)
	{
		return $this->tableDataArray[$index];
	}	

}