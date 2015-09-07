<?php

require __DIR__ . '/../model/Table.php';
require __DIR__. '/../model/TableSquare.php';

class Controller
{

    public function index()
    {
        
        $table = new Table();
        $squares = $table->getSquares();
                        
        $poolCount = 0;
        $biggestPool = 0;
        $poolSize = 0;
       
        // Analyze the table ..
        for ($i = 0; $i < 400; $i++)
        {           
            if ($table->getSquareAtIndex($i)->getValue() === 1)
            {
                $extractedPool = $table->extractPoolAtIndex($i);
                // After we extract the pool out of the table, we need to clean 
                // the table on the place, from where the pool has been 
                // extracted ..
                $table->clean($extractedPool);
                $poolCount++;
                $poolSize = sizeof($extractedPool);
            }

            if ($poolSize > $biggestPool)
                $biggestPool = $poolSize;
        }
        
        // Draw the table here .. 
        $loader = new Twig_Loader_Filesystem(__DIR__ . '/../view/');
        $twig = new Twig_Environment($loader);
        echo $twig->render('index.twig', array('squares' => $squares, 'poolCount' => $poolCount, 'biggestPool' => $biggestPool));
    }

}
