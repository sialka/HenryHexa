<?php
/*
 *
 *
 */

session_start();

require_once "vendor/autoload.php";

use \Slim\Slim;

$app = new Slim();

$app->config('debug', true);

    require_once "routes/site.php";

$app->run();

?>