<?php

use App\Kernel;
use Symfony\Component\HttpFoundation\Request;

require dirname(__DIR__) . '/vendor/autoload.php';

$env = $_SERVER['APP_ENV'] ?? 'prod';
$debug = ($_SERVER['APP_DEBUG'] ?? '0') === '1';

$kernel = new Kernel($env, $debug);

$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
