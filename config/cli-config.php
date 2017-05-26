<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once __DIR__ . '/../src/UnnamedProject/bootstrap.php';

$entityManager = $app['orm.em'];

return ConsoleRunner::createHelperSet($entityManager);
