<?php

ob_start();

require_once( dirname(__FILE__)."/controller/ROUTER.php" );
require_once( dirname(__FILE__)."/controller/USER.php" );

$user = new USER();
$router = new ROUTER();

$router->route($_GET);