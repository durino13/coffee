<?

class Table
{
	
	protected $tableSquareCount;
	protected $tableDataArray;

	public function __construct()
	{
		$this->tableSquareCount = 400;
		$this->init();
	}

	/**
	* Initialize the table data with random values
	*/
	private function init()
	{
		// for ($i=0; $i < $this->tableSquareCount; $i++) {
		// 	$this->tableDataArray[$i] = rand(0, 1);
		// }
		$this->tableDataArray = [1,1,0,1,0,1,1,0,0,1,0,1,1,0,0,1,1,1,1,0,0,0,1,1,0,1,0,0,0,1,0,1,1,0,0,1,1,0,0,1,1,0,0,0,0,1,0,0,1,1,1,1,0,1,1,1,0,1,1,0,0,1,0,0,1,1,0,1,1,0,0,1,1,1,1,0,1,0,0,0,0,0,0,1,1,1,0,1,1,1,0,0,1,0,0,0,1,0,1,1,1,0,0,0,0,0,0,1,0,1,1,0,1,0,1,1,1,0,0,1,0,1,1,1,0,0,1,0,0,1,1,0,0,1,0,0,0,0,1,0,0,1,1,1,1,1,0,1,1,1,0,1,1,0,0,1,0,0,1,1,0,1,1,0,0,1,0,0,0,0,1,0,0,0,0,0,1,1,1,1,1,0,0,0,0,1,1,0,1,1,0,0,0,1,0,1,1,1,0,0,0,0,1,0,0,0,0,0,1,0,0,1,0,0,1,0,0,1,1,0,1,0,0,1,1,0,1,1,0,0,1,0,0,0,1,1,0,1,1,0,0,1,1,0,0,1,1,0,1,0,0,0,1,0,0,0,1,1,0,0,1,1,1,0,0,0,1,1,0,1,0,0,1,0,0,1,1,1,0,0,0,1,0,1,0,0,0,0,0,1,0,0,1,1,0,1,0,1,1,0,1,1,1,0,0,0,0,1,0,0,1,1,0,0,1,0,1,1,0,1,0,1,0,1,1,0,1,1,0,1,0,1,1,0,0,1,0,0,0,0,1,0,1,1,1,0,0,0,0,1,0,1,0,0,1,0,0,1,0,1,0,1,1,0,1,1,1,0,1,0,0,0,1,0,0,0,1,0,0,0,1,1,0,1,1,1,0,0,1,0,1,1,1,0,1,1,1,1,1,1];
	}	

	/**
	* Create the table
	*/
	public function create()
	{
		return $this->tableDataArray;
	}

	/** 
	* This function will count coffee squares next to a square with a specific index
	*/
	public function getNeighbourCoffeeSquaresIndexes($index)	
	{
		$offsets = [-21, -20, -19, -1, 1, 19, 20, 21];

		$indexesFound = [];

		foreach ($offsets as $offset) {
			if (($index-$offset >= 0) && ($index+$offset <= $this->tableSquareCount))
			{
				if ($this->tableDataArray[$index-$offset] === 1)
				{
					array_push($indexesFound, $index-$offset);
				}					
			}
						
		}

		return $indexesFound;
	}

}