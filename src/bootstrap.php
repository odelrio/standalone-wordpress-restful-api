<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;

$app->register(new Silex\Provider\DoctrineServiceProvider(), [
	'db.options'    => [
		'driver'        => 'pdo_sqlite',
		'path'          => __DIR__ . '/../support/wordpress/wp-content/database/wordpress.sqlite',
		'charset'       => 'utf8'
	]
]);

$app->register(new Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider(), [
	'orm.em.options' => [
		'mappings' => [
			[
				'type'      => 'yml',
				'namespace' => 'Entity',
				'path'      => realpath(__DIR__ . '/../config/doctrine')
			]
		]
	]
]);
