<?php

require_once 'instantiate_slim.php';

$app->get('/appsettings', function () use ($app, $db) {
    pprint($app->container['settings']);
    echo "</pre>";
});

$app->get('/hello/:name', function ($name) use ($app, $db) {
    pprint($db->getUserInfo($name));
});

$app->get('/yo', function () use ($app, $db) {
    echo $app->render('layout.html', array('heading' => 'World'));
});

$app->run();
