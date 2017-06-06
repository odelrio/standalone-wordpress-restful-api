<?php

require_once __DIR__ . '/../../../../../../vendor/autoload.php';

$app = \UnnamedProject\Infrastructure\Http\Silex\Application::getInstance();

$app->mount('/posts', new \UnnamedProject\Infrastructure\Http\Silex\Controllers\PostsController());
//$app->mount('/users', new \UnnamedProject\Infrastructure\Http\Silex\Controllers\UsersController());
//$app->mount('/terms', new \UnnamedProject\Infrastructure\Http\Silex\Controllers\TermsController());

$app->run();