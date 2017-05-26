<?php

require_once __DIR__ . '/bootstrap.php';

$app['debug'] = true;

$app->get('/hello/{name}', function($name) use ($app) {
	return 'Hello ' . $app->escape($name);
})->value('name', 'world');

$app->get('/about', function() {
	return 'Testing';
});

$app->get('/', function() use ($app) {
	$em = $app['orm.em'];

	var_dump($em->getRepository('UnnamedProject\Domain\Model\Posts')->findAll());

	return '';
});

$app->run();