<?

require __DIR__.'/../model/Table.php';

class Controller 
{
	
	public function index()
	{
		$table = new Table();
		$squares = $table->create();
		$poolCount = 0;
		$biggestPool = 0;
		$poolSize = 0;

		for ($i=0; $i < 399; $i++) { 
			if ($table->getValueAtIndex($i) === 1)
			{
				$extractedPool = $table->extractPoolAtIndex($i);
				// pr('Extracted pool: ', $extractedPool);
				// After we extract the pool out of the table, we need to clean the table on the place, from where the pool has been extracted ..
				$table->clean($extractedPool);
				$poolCount++;			
				$poolSize = sizeof($extractedPool);
			}

			if ($poolSize > $biggestPool)
				$biggestPool = $poolSize;
		}
		
		
		$loader = new Twig_Loader_Filesystem(__DIR__.'/../view/');
		$twig = new Twig_Environment($loader);
		echo $twig->render('index.twig', ['squares' => $squares, 'poolCount' => $poolCount, 'biggestPool' => $biggestPool]);

	}

}