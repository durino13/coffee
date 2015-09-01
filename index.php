<?

require_once 'vendor/autoload.php';
require_once 'controller/Controller.php';

function pr($label, $data)
{
	if (true)
	{
		echo "<b> $label </b>";
	    echo "<pre>";
	    print_r($data); // or var_dump($data);
	    echo "</pre>";		
	}

}

$controller = new Controller();
$controller->index();