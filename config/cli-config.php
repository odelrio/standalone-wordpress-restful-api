<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/UnnamedProject/Infrastructure/Http/Silex/Application.php';

$app = \UnnamedProject\Infrastructure\Http\Silex\Application::getInstance();

return ConsoleRunner::createHelperSet($app['orm.em']);