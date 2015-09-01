<?

require __DIR__.'/../model/Table.php';

class Controller 
{
	
	public function index()
	{
		$table = new Table();
		$squares = $table->create();
		

		$squaresScanned = [];
		$squaresToScan = [];

		// Find the first cofee square on the table
		$index = 357; // hardcoded ..

		// Rescan all the neighbour squares next to this scanned square and store the result in squaresToScan
		$squaresToScan = $table->getNeighbourCoffeeSquaresIndexes($index);
		pr("Indexes found next to $index:", $squaresToScan);		

		// add index of the founded square into squaresScanned
		array_push($squaresScanned, $index);
		pr("Squares scanned so far: ", $squaresScanned);
		pr("Squares to scan in the next loop: ", $squaresToScan);

		// Loop over the squaresToScan array and scan every square in the array
		while (!empty($squaresToScan))
		{

			$temp = [];
			$loop = 0;

			foreach ($squaresToScan as $squareIndex) 
			{

			 	// for every coffee square get the index of another neighbour squares 
			 	$ns = $table->getNeighbourCoffeeSquaresIndexes($squareIndex);
			 	pr("Squares next to $squareIndex: ", $ns);

			 	// add the neighbours to scan to the list of the squarestoscan
			 	$temp = array_unique(array_merge($temp, $ns));
			 	pr("Squares to scan: ", $temp);

				// add the scanned square into 'squaresScanned'
				array_push($squaresScanned, $squareIndex);
				pr('Squares scanned: ', $squaresScanned);

			 	// substract the squaresScanned from the squaresToScan, so we don't scan the squares, we scanned previously
			 	// $temp1 = array_diff($ns, $squaresScanned);
			 	// pr('Scan this in the next loop: ', $temp1);

			}

			$squaresToScan = array_diff($temp, $squaresScanned);
			pr('Squares to scan in the next loop: ', $squaresToScan);

		}

		
		$loader = new Twig_Loader_Filesystem(__DIR__.'/../view/');

		$twig = new Twig_Environment($loader);
		echo $twig->render('index.twig', ['squares' => $squares]);

	}

}