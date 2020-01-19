<?php

ob_start();

require_once( dirname(__FILE__)."/controller/ROUTER.php" );
require_once( dirname(__FILE__)."/controller/TMP.php" );

$tmp = new TMP();
$router = new ROUTER();

$router->route($_GET);