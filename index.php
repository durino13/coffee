<?php

require_once 'vendor/autoload.php';
require_once 'controller/Controller.php';

/*
 * For the purpose of this application, the controller is not necessary, but 
 * I prefer to have it anyway ..
 */
$controller = new Controller();
$controller->index();
