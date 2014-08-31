<?php
date_default_timezone_set('Asia/Kolkata');
require '../vendor/autoload.php';
$app = new \Slim\Slim(array(
    'templates.path' => '../templates',
));


$app->container->singleton('log', function () {
    $log = new \Monolog\Logger('slim-skeleton');
    $log->pushHandler(new \Monolog\Handler\StreamHandler('../logs/app.log', \Monolog\Logger::DEBUG));
    return $log;
});

// Prepare view
$app->view(new \Slim\Views\Twig());
$app->view->parserOptions = array(
    'charset' => 'utf-8',
    'cache' => realpath('../templates/cache'),
    'auto_reload' => true,
    'strict_variables' => false,
    'autoescape' => true
);

$app->view->parserExtensions = array(new \Slim\Views\TwigExtension());

require_once '../model/model.php';
require_once '../db/dbconn.php';

$dbconn_instance = new DB_Connect();
$db = new DB_Model($dbconn_instance);

require_once '../helpers/utils.php';
