<?php 
define('ENVIRONMENT', 'development');

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

/*Initializing App*/
$appConfig = require_once '../env/' . ENVIRONMENT . '.php';
$app = new \Slim\App(['settings' =>  $appConfig]);

//Adding logger
$container = $app->getContainer();
$container['logger'] = function($c) {
    $logger = new \Monolog\Logger($c['settings']['logger']['name']);
    $file_handler = new \Monolog\Handler\StreamHandler($c['settings']['logger']['path'], $c['settings']['logger']['level']);
    $logger->pushHandler($file_handler);
    return $logger;
};

//Adding custom util class
$container['util'] = function($c) {
    $util = new \AppHelper\Util($c['settings'], $c['logger']);    
    return $util;
};

//Adding Test Route
$app->get('/', function (Request $request, Response $response, array $args) {    
    $this->logger->info(json_encode($request->getHeaders()));
    $data = array('msg' => 'Hello World!!!');     
    return $response->withJson($data);
});

//Adding other routes
require '../routes/routes.php';

//Running App
$app->run();

