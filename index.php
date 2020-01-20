<?php

ob_start();

require_once( dirname(__FILE__)."/controller/ROUTER.php" );
$router = new ROUTER();

$router->route($_GET);