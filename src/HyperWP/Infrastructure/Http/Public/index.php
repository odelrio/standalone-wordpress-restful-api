<?php

require_once __DIR__ . '/../../../../../vendor/autoload.php';
require_once __DIR__ . '/../../../../../config/config.php';

$app = \HyperWP\Infrastructure\Http\Application::getInstance();

$app->route([
    '/posts' => ['\HyperWP\Infrastructure\Http\Controllers\V1\PostsController', 'all'],
    '/posts/{year:\d{4}}' => ['\HyperWP\Infrastructure\Http\Controllers\V1\PostsController', 'byYear'],
    '/posts/{year:\d{4}}/{month:\d{2}}' => ['\HyperWP\Infrastructure\Http\Controllers\V1\PostsController', 'byMonth'],
    '/posts/{year:\d{4}}/{month:\d{2}}/{day:\d{2}}' => ['\HyperWP\Infrastructure\Http\Controllers\V1\PostsController', 'byDay'],

    '/compat/wp/v2/posts' => ['\HyperWP\Infrastructure\Http\Controllers\Compatibility\WPv2\PostsController', 'all'],
]);

$app->run();