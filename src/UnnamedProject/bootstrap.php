<?php

require_once __DIR__ . '/../../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;

$app->register(new Silex\Provider\DoctrineServiceProvider(), [
	'db.options'    => [
		'driver'        => 'pdo_sqlite',
		'path'          => __DIR__ . '/../../support/wordpress/wp-content/database/wordpress.sqlite',
//		'driver' => 'pdo_mysql',
//		'host' => '127.0.0.1',
//		'dbname' => 'wordpress',
//		'user' => 'root',
//		'password' => 'toor',
//		'driverOptions' => array(1002 => 'SET NAMES utf8',),
//		'charset'       => 'utf8'
	]
]);

$app->register(new Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider(), [
	'orm.em.options' => [
		'mappings' => [
			[
				'type'      => 'simple_yml',
				'namespace' => 'UnnamedProject\Domain\Model',
				'path'      => realpath( __DIR__ . '/../../config/doctrine' )
			]
		]
	]
]);